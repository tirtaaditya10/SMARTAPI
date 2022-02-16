get_sas_token() {

    local EVENTHUB_URI="https://nidndvloyaidslnasse02sta.blob.core.windows.net/"

    local SHARED_ACCESS_KEY_NAME="glbl-pr-pbiauditanalyticsautomation-id-euno-spn"

    local SHARED_ACCESS_KEY="6dc7Q~_KED8X7UvUTj~susUYeDnGtfXqwYUGt"

    local EXPIRY=${EXPIRY:=$((60 * 60 * 24))} # Default token expiry is 1 day


    local ENCODED_URI=$(echo -n $EVENTHUB_URI | jq -s -R -r @uri)

    local TTL=$(($(date +%s) + $EXPIRY))

    local UTF8_SIGNATURE=$(printf "%s\n%s" $ENCODED_URI $TTL | iconv -t utf8)


    local HASH=$(echo -n "$UTF8_SIGNATURE" | openssl sha256 -hmac $SHARED_ACCESS_KEY -binary | base64)

    local ENCODED_HASH=$(echo -n $HASH | jq -s -R -r @uri)


    echo -n "SharedAccessSignature sr=$ENCODED_URI&sig=$ENCODED_HASH&se=$TTL&skn=$SHARED_ACCESS_KEY_NAME"

}
