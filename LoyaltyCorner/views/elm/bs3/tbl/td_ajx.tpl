{assign var='url' value=$sys.req.rid|cat:'/'|cat:$i.id}
<td class="text-center">
	<a class="ajx" href="javascript:" title="Edit"
	   data-target="#{$target|default:$sys.uix.pcd}"
       data-url="#{$url}{$td_url|default:''}{block name="td_url"}{/block}"><i class="fa fa-edit hovicon tiny effect-8"></i>
	</a>
</td>
