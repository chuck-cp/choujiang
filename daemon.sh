#!/bin/sh


/bin/ps -ef | grep 'prize/url' | grep -v 'grep' > /dev/null 2>&1
if [ $? -eq 0 ];then
    echo 'ok'
else
     echo "prize/url";/usr/local/bin/php /var/www/huodong/yii prize/url > /dev/null  &
fi


/bin/ps -ef | grep 'prize/grant' | grep -v 'grep' > /dev/null 2>&1
if [ $? -eq 0 ];then
    echo 'ok'
else
     echo "prize/grant";/usr/local/bin/php /var/www/huodong/yii prize/grant > /dev/null &
fi

/bin/ps -ef | grep 'system_send_message_to_mobile' | grep -v 'grep' > /dev/null 2>&1
if [ $? -eq 0 ];then
    echo 'ok'
else
    echo "system_send_message_to_mobile";/usr/sbin/python3 /var/www/huodong/scripts/system_send_message_to_mobile.py &
fi