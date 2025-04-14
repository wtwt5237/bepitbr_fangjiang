#! /usr/bin/perl -w

use warnings;
use DBI;
use strict;

## get word directory
my $path = $ENV{'remoter_path'};
## get db config
my $db_host = $ENV{'remoter_host'};
my $db_username = $ENV{'remoter_usr'};
my $db_password = $ENV{'remoter_passwd'};
my $db_dbname = $ENV{'remoter_db'};

my $STATUS_NEWJOB = 0;
my $STATUS_SUCCESS = 1;
my $STATUS_PROCESSING = 2;
my $STATUS_FAIL = 9;

my $successmail = 1;

##########################################
## input: job ID, Analysis Method
## output: all of results are saved to DB
##########################################

sub bepi
{

	my($jobid) = @_;

	if($jobid eq ""){exit;}

	my @parameters = getparameters($jobid);

	# read data
	my $inst = $parameters[0];
	my $email = $parameters[1];
	my $mode = $parameters[2];
	my $thread = $parameters[3];
	my $length = $parameters[4];
	my $motif0_file = $parameters[5];
	my $full0_file = $parameters[6];
	my $full0 = $parameters[7];
	my $fasta0 = $parameters[8];

	# Clean the variables
	$jobid = nomalize($jobid);
	$inst = nomalize($inst);
	$email = nomalize($email);
  	$mode = nomalize($mode);

	changestatus($jobid, $STATUS_PROCESSING);

	# define path for input folders
	my $input_path = $path."/bepiTBR/bepi-model/output/".$mode."_".$jobid;
    my $fasta_fname = $mode."_".$jobid;

    # create output folder
	system("mkdir ".$input_path);
	# open all permission
	system("chmod -R 777 ".$input_path);

	# write input file
	if ($mode eq "epitope") {

	my $motifname = $input_path."/Ind-positive.txt";
    	my $fullname = $input_path."/peptide_with_full_length.txt";
    	open (my $fh1, '>', $motifname) or die $!;
    	print $fh1 $motif0_file;
    	close $fh1;

    	open (my $fh2, '>', $fullname) or die $!;
    	print $fh2 $full0_file;
    	close $fh2;

	}

	if ($mode eq "fullprotein") {

    	my $fullname = $input_path."/example_full.txt";
    	open (my $fh1, '>', $fullname) or die $!;
    	print $fh1 $full0;
    	close $fh1;

	}

	if ($mode eq "fasta") {

    	my $fastaname = $input_path."/peptide_with_full_length.txt";
    	open (my $fh1, '>', $fastaname) or die $!;
    	print $fh1 $fasta0;
    	close $fh1;

	}

	# --------------------------------  run program  -------------------------------------- #

	$ENV{'input_path'} = $input_path;
	$ENV{'fasta_fname'} = $fasta_fname;
	$ENV{'mode'} = $mode;
	$ENV{'thread'} = $thread;
	$ENV{'length'} = $length;
    #  Local develop env
    system("echo 'start to execute BepiPred2.0 ......'");
	system("bash ".$path."/bepiTBR/bepi-model/bepi.sh");

	# --------------------------------  output  -------------------------------------- #
	my $resTXT;

	my $output_path;
	if ($mode eq "fasta") {
	    $output_path = $input_path."/output.tar.gz";
	} else {
	    $output_path = $input_path."/predictions.txt";
	}

	my $merged_R = $path."/bepiTBR/bepi-model/merged.R";
	my $bcell = $path."/bepiTBR/bepi-model/bcell_linear_peptide.csv";

	system("/home/dbai/miniconda3/bin/Rscript ".$merged_R." ".$output_path." ".$bcell." ".$input_path."/output.csv");
	system('/usr/bin/php '.$path.'/bepiTBR/bepi-model/csvtojson.php mode='.$mode.' jobid='.$jobid);

    # timer to track the progress
    my $timer = 0;
    # test 5 times
    while ((! -e $input_path."/predictions.txt" && ! -e $input_path."/output.tar.gz") && $timer < 50) {
    	sleep 6;
    	$timer++;
    }

    if ($timer < 50) {

            		# read result txt file
            		open TXT, $output_path;

            		my $buff = "";
            		while(read TXT, $buff, 1024) {
            					 $resTXT .= $buff;
            		}
            		close TXT;

            		# update database with result

            		my $dbh1 = DBI->connect('DBI:mysql:' . $db_dbname . ';host=' . $db_host, $db_username, $db_password)
            		 or die "Can't connect: " . DBI->errstr();

            		my $stm = $dbh1->prepare("INSERT INTO BepiResults(JobID, predictions) VALUES (?, ?);");
            			 $stm->bind_param(1, $jobid);
            			 $stm->bind_param(2, $resTXT, DBI::SQL_BLOB);
            			 $stm->execute();
            			 $stm->finish();
            			 $dbh1->disconnect();

     		 # change job status as success
    	     changestatus($jobid, $STATUS_SUCCESS);
    	}
    	else
    	{
    	    # change job status as success
            changestatus($jobid, $STATUS_FAIL);
            system("php /home/dbai/html/bepitbr/phpmailer/mailer.php " . $email . " " . $jobid . " 0");
            $successmail = 0;
    	}

    	# send email alert
    	if ($email and $successmail == 1) {
    	    system("php /home/dbai/html/bepitbr/phpmailer/mailer.php " . $email . " " . $jobid . " 1");
    	}

    	# remove temporary file
#    	system("rm -R " . $input_path);
}


###########################################################################################
## Below are the private methods for public methods above
###########################################################################################


## Get the parameters by JOBID
sub getparameters
{
	my($jobid) = @_;

	# connect to database
	my $dbh = DBI->connect('DBI:mysql:' . $db_dbname . ';host=' . $db_host, $db_username, $db_password)
			   or die "Can't connect: " . DBI->errstr();

	# Get jobid which has not been dealt with
	my $sth1 = $dbh->prepare("SELECT Inst, Email, Mode, Thread, Length, motif0_file, full0_file, full0, fasta0 FROM BepiParameters WHERE JobID = \"". $jobid ."\"")
				or die("Prepare of SQL failed" . $dbh->errstr());
	$sth1->execute();
	my @result1 = $sth1->fetchrow_array();

	$sth1->finish();
	$dbh->disconnect();

	return @result1;
}


# Perl trim function to remove whitespace from the start and end of the string and remove " amd '
sub nomalize($) {
	my $string = shift;
	$string =~ s/^\s+//;
	$string =~ s/\s+$//;
	$string =~ s/'//g;
	$string =~ s/"//g;
	return $string;
}
