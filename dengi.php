<?
$project = '6084';
$secret = 'sgJF2znnzmpITAG4nCtrImHs';
$timestamp = time();
$action = 'check';
$params = '40389682718384154840081510113509094281234opt_29';

/*
Номер провайдера для выплат на Визу 1011350
(Например, для тэгов вида <params><aaa>v1</aaa><zzz>v2</zzz><bbb>v3</bbb></params> строка будет иметь вид: v1v3v2)

<params><date_from>2013-10-20</date_from></params>

код 840 означает доллары, рубли имеют код 643(согласно ISO 4217)

paysystems — получение списка доступных систем – получателей платежа и их параметров;
rates — получение списка курсов конвертации валют;
main_balance — получение суммы основного баланса;
check — предзапрос на проведение выплаты;
pay — запрос на проведение выплаты;
pay_status — получение статуса транзакции по ее идентификатору;
errors — получение списка кодов уведомлений и их описаний;
balances — получение списка региональных балансов и их значений;
balance_transfer — распоряжение на перевод средств между балансами.

<params>
	<account>4154826902758527</account>
	<amount>1</amount>
	<expiry>0714</expiry>
	<paysystem>1011350</paysystem>
	<phone>9094281234</phone>
	<txn_id>opt_3</txn_id>
</params>
*/

$signString = md5($timestamp .$project . $action . $params . $secret);


$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<request>
  <project>$project</project>
  <action>$action</action>
  <timestamp>$timestamp</timestamp>
  <sign>$signString</sign>
  <params>
	<account>4038968271838415</account>
	<amount>4</amount>
	<currency>840</currency>
	<expiry>0815</expiry>
	<paysystem>1011350</paysystem>
	<phone>9094281234</phone>
	<txn_id>opt_29</txn_id>
  </params>
</request>";

echo $xml;
echo "\n----------------\n";

 $url = "http://gsg.dengionline.com/api";
 $page = "/api";
 $headers = array("POST ".$page." HTTP/1.0",
                     "Content-type: text/xml;charset=\"utf-8\"",
                     "Accept: text/xml",
                     "Content-length: ".strlen($xml));
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
 $result = curl_exec($ch);
 curl_close($ch);

 echo "\nResult:\n"; 
 echo $result; 
 
 //$resp = new SimpleXMLElement($result);
 //echo($resp->response->status);

/*
<response>
	<status>1</status>
	<reference>31803342</reference>
	<timestamp>1383434698</timestamp>
	<invoice>6840852</invoice>
	<income currency="840">1</income>
	<amount currency="840">1</amount>
	<outcome currency="643">81.6981</outcome>
	<rate income="1" outcome="31.6981" total="31.6981"></rate>
</response>

<response>
	<status>2</status>
	<reference>31803584</reference>
	<timestamp>1383435289</timestamp>
	<invoice>6840856</invoice>
	<income>10</income>
	<rate>31.6981</rate>
	<amount>10</amount>
	<outcome>366.9809</outcome>
	<fee>56.3396</fee>
</response>

ссылка на протокол:
http://paygate.dengionline.com/docs/protocol
ключ: sgJF2znnzmpITAG4nCtrImHs
id проекта : 6084

4038968270489798

4038979470990675
*/

?>
