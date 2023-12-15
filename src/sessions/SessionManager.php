<?php
class SessionManager {
    public function redirectToAppropriatePage() {
        if (isset($_SESSION['user_id'])) {
            header("Location: public/calculator.html");
            exit;
        } else {
            header("Location: public/login.html");
            exit;
        }
    }
}
?>
