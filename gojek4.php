<?php

error_reporting(0);
include ("func.php");
echo "\e            GOJEK VERSION 1.4.1              \n";
echo "\e SCRIPT GOJEK AUTO REGISTER + AUTO CLAIM VOUCHER\n";
echo "\n";
nope:
echo "\e[?] Masukkan Nomor HP Anda (1) : ";
$nope = trim(fgets(STDIN));
$cek = cekno($nope);
if ($cek == false)
    {
    echo "\e[x] Nomor Telah Terdaftar\n";
			goto nope;
    }
  else
    {
echo "\e ".$cek."\n";
echo "\e[!] Siapkan OTPmu\n";
sleep(5);
$register = register('1'.$nope);
if ($register == false)
    {
    echo "\e[x] Failed Get OTP!\n";
    }
  else
    {
    otp:
    echo "\e[!] Masukkan Kode Verifikasi (OTP) : ";
    $otp = trim(fgets(STDIN));
    $verif = verif($otp, $register);
    if ($verif == false)
        {
        echo "\e[x] Kode Verifikasi Salah\n";
        goto otp;
        }
      else
        {
		$h=fopen("newgojek.txt","a");
		fwrite($h,json_encode(array('token' => $verif, 'voc' => 'gofood gak ada'))."\n");
		fclose($h); 
            echo "\e[!] Trying to redeem Voucher : COBAINGOJEK !\n";
            sleep(3);
            $claim = ride($verif);
            if ($claim == false){
            echo "\e[!] Failed to Claim Voucher, Try to Claim Manually\n";
			      sleep(3);
            echo "\e[!] Trying to redeem Voucher : AYOCOBAGOJEK !\n";
            sleep(3);
			      goto pengen;
            }else{
            echo "\e[+] ".$claim."\n";
				    sleep(3);
            echo "\e[!] Trying to redeem Voucher : AYOCOBAGOJEK !\n";
            sleep(3);
            goto pengen;
            }
            pengen:
            $claim = cekvocer($verif);
            if ($claim == false ) {
            echo "\e[!] Failed to Claim Voucher, Try to Claim Manually\n";
            }
            else{
            echo "\e[+] ".$claim."\n";  
        }
    }
    }
    }


?>
