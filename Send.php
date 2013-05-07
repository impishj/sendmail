<?php

class Send {

    public $from;
    public $fromName;
    public $to;
    public $subject;
    public $message;
    public $signature;

    public static function mail() {
        return new Send();
    }

    public function from($from) {
        $this->from = $from;
        return $this;
    }

    public function fromName($fromName) {
        $this->fromName = $fromName;
        return $this;
    }

    public function to($to) {
        $this->to = $to;
        return $this;
    }

    public function subject($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function message($message) {
        $this->message = $message;
        return $this;
    }

    public function signature($signature) {
        $this->signature = "\n\n-- \n" . $signature . "\n";
        return $this;
    }

    public function send() {
        $mailFrom = $this->from;
        $mailFromName = $this->fromName;
        $mailTo = $this->to;
        $mailSubject = $this->subject;

        $mailSignature = ;
        $mailSignature .= "Vaš, Format.ba - Primjenjene Vještine.\n";
        $mailSignature .= "Za više informacija posjetite nas na: http://www.format.ba/\n";

        $mailBody = $this->message . "\n";
        $mailBody .= $this->signature;

        $mailHeader = "From: $mailFromName <$mailFrom>\r\n";
        $mailHeader .= "MIME-Version: 1.0\r\n";
        $mailHeader .= "Content-type: text/html; charset=UTF-8\r\n";
        $mailHeader .= "Reply-To: $mailFromName <$mailFrom>\r\n";
        $mailHeader .= "X-Mailer: Mailsend.php\r\n";
        $mailHeader .= "X-Sender-IP: {$_SERVER['REMOTE_ADDR']}\r\n";
        $mailHeader .= "Bcc: $mailFromName <$mailFrom>\r\n";

        $mailParams = "-f$mailFrom";

        $mailBody = str_replace('  ', '', $mailBody);

        return mail($mailTo, $mailSubject, $mailBody, $mailHeader, $mailParams);
    }

    public function valid($email) {
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            return false;
        }

        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);

        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }

        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) {
            $domain_array = explode(".", $email_array[1]);

            if (sizeof($domain_array) < 2) {
                return false;
            }

            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }

        return true;
    }

}
