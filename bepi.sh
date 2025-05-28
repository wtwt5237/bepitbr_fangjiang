#!/usr/bin/sh

main_path=/home/dbai/remoteR/bepiTBR
raku_path=/home/dbai/remoteR/bepiTBR/bepi-model/rakudo/bin/raku

if [ $mode == "epitope" ]
then
####### Epitope Mode ######
$raku_path $main_path/bepi-model/BepiTBR.raku \
--motif0_file=$input_path/Ind-positive.txt \
--full0_file=$input_path/peptide_with_full_length.txt \
--bepipred2=$main_path/bepi-model/bp2/bin/activate \
--bepipred1=$main_path/bepi-tools/bepipred-1.0/bepipred \
--LBEEP=$main_path/bepi-tools/LBEEP \
--MixMHC2pred=$main_path/bepi-tools/MixMHC2pred/MixMHC2pred_unix \
--netMHCIIpan=$main_path/bepi-tools/netMHCIIpan-3.2/netMHCIIpan \
--dir=$input_path \
--thread=$thread \
--raku_path=$raku_path \
--main_path=$main_path

elif [ $mode == "fullprotein" ]
then
####### Full Protein Mode ######
$raku_path $main_path/bepi-model/BepiTBR_full.raku \
--full0=$(cat $input_path/example_full.txt) \
--length=$length \
--bepipred2=$main_path/bepi-model/bp2/bin/activate \
--bepipred1=$main_path/bepi-tools/bepipred-1.0/bepipred \
--LBEEP=$main_path/bepi-tools/LBEEP \
--MixMHC2pred=$main_path/bepi-tools/MixMHC2pred/MixMHC2pred_unix \
--netMHCIIpan=NA \
--dir=$input_path \
--thread=$thread \
--raku_path=$raku_path \
--main_path=$main_path

elif [ $mode == "fasta" ]
then
###### Fasta Mode ######
$raku_path $main_path/bepi-model/BepiTBR_fasta.raku \
--fasta0=$input_path/peptide_with_full_length.txt \
--length=$length \
--bepipred2=$main_path/bepi-model/bp2/bin/activate \
--bepipred1=$main_path/bepi-tools/bepipred-1.0/bepipred \
--LBEEP=$main_path/bepi-tools/LBEEP \
--MixMHC2pred=$main_path/bepi-tools/MixMHC2pred/MixMHC2pred_unix \
--netMHCIIpan=NA \
--dir=$input_path \
--thread=$thread \
--raku_path=$raku_path \
--main_path=$main_path \
--fasta_fname=$fasta_fname

fi
