<?php
$msgs = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $token = "1269231142:AAHN186wm9LP6gsE8rG0onc1a-0C4G91bk0";
    $chat_id = "-401549979";
 
    if (!empty($_POST['name']) && !empty($_POST['phone'])){
        $bot_url = "https://api.telegram.org/bot{$token}/";
        $urlForPhoto = $bot_url . "sendPhoto?chat_id=" . $chat_id;
 
        if (isset($_POST['name'])) {
          if (!empty($_POST['name'])){
            $name = "Имя пославшего: " . strip_tags($_POST['name']) . "%0A";
          }
        }
 
        if (isset($_POST['phone'])) {
          if (!empty($_POST['phone'])){
            $phone = "Телефон: " . "%2B" . strip_tags($_POST['phone']) . "%0A";
          }
        }

        if (isset($_POST['email'])) {
            if (!empty($_POST['email'])){
              $email = "E-mail: " . strip_tags($_POST['email']) . "%0A";
            }
          }
 
        if (isset($_POST['theme'])) {
          if (!empty($_POST['theme'])){
            $theme = "Тема: " .strip_tags($_POST['theme']);
          }
        }
        // Формируем текст сообщения
        $txt = $name . $phone . $email . $theme;
 
        $sendTextToTelegram = file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}");
        if ($output && $sendTextToTelegram) {
            $msgs['okSend'] = 'Спасибо за отправку вашего сообщения!';
            echo json_encode($msgs);
        } elseif ($sendTextToTelegram) {
            $msgs['okSend'] = 'Спасибо за отправку вашего сообщения!';
            echo json_encode($msgs);
          return true;
        } else {
            $msgs['err'] = 'Ошибка. Сообщение не отправлено!';
            echo json_encode($msgs);
            die('Ошибка. Сообщение не отправлено!');
        }
 
    } else {
        $msgs['err'] = 'Ошибка. Вы заполнили не все обязательные поля!';
        echo json_encode($msgs);;
    }
} else {
  header ("Location: /");
}
?>