while :
do
for i in {5..1}
do 
  if [ $((i%1)) == 0 ]
  then 
    echo -n "$i."
  fi
  sleep 1
done
curl http://localhost:8080/Whatsapp/outbound.php
done


