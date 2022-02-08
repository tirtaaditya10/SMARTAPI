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
curl http://localhost:8080/Api/Sms/sendmymaskingsms
curl http://localhost:8080/Api/Sms/sendnewsms
done
