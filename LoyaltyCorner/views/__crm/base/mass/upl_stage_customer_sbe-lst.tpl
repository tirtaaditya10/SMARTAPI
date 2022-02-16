{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="custom"}
    {assign var="custom"    value=1}
{/block}
{block name="th"}
    <th width="20%">Action</th>
    <th width="8%">Procom Date</th>
    <th width="8%">Created On</th>
    <th width="8%">Mom's Name</th>
    <th width="8%">Phone Number 1</th>
    <th width="8%">Phone Number 2</th>
    <th width="8%">Child Name</th>
    <th width="8%">Child Birth Date</th>
    <th width="8%">Address</th>
    <th width="8%">Email</th>
    <th width="8%">Created By (BP)</th>
{/block}
{block name="td"}
    {assign var="prev_number"   value=0}
    {assign var="prev_id"       value=0}
    {foreach from=$sys.rsp.dat item=i}
        {if $i.phone_number_1 eq $prev_number}
            <tr>
                <td>
                    <button onclick="sbeFlag($prev_number, $prev_id, $i.id, 1)"  data-toggle="tooltip" title="Double" class="btn btn-danger btn-circle"><i class="glyphicon glyphicon-eye-close"></i></button>
                    <button onclick="sbeFlag($prev_number, $prev_id, $i.id, 2)"  data-toggle="tooltip" title="Valid" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-eye-open"></i></button>
                </td>
                <td>{$i.acq_date}</td>
                <td>{$i.created_on}</td>
                <td>{$i.customer_name}</td>
                <td>{$i.phone_number_1}</td>
                <td>{$i.phone_number_2}</td>
                <td>{$i.children_name}</td>
                <td>{$i.children_birthday}</td>
                <td>{$i.address}</td>
                <td>{$i.email}</td>
                <td>{$i.wcrm_brand_presenter}</td>
            </tr>
        {else}
            {assign var="prev_id"       value=$i.id}
            <tr class="danger">
                <td></td>
                <td>{$i.acq_date}</td>
                <td>{$i.created_on}</td>
                <td>{$i.customer_name}</td>
                <td>{$i.phone_number_1}</td>
                <td>{$i.phone_number_2}</td>
                <td>{$i.children_name}</td>
                <td>{$i.children_birthday}</td>
                <td>{$i.address}</td>
                <td>{$i.email}</td>
                <td>{$i.wcrm_brand_presenter}</td>
            </tr>
        {/if}
        {assign var="prev_number"       value=$i.phone_number_1}
    {/foreach}
{/block}
{block name="jquery_page_ready"}
    function sbeFlag(PREV_NUMBER, PREV_ID, ID, FLAG){
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/sbeFlag',
            data: {
                flag: FLAG,
                prev_id: PREV_ID,
                prev_number: PREV_NUMBER,
                id:  ID
            },
            cache: false,
            success: function (response) {
                console.log(response);
                if(response == 'success'){
                    swal("Success", "", "success")
                    .then((value) => {
                    location.reload();
                });
                }
                else {
                    swal("Failed", "", "error");
                }
            }
        });
    }
{/block}