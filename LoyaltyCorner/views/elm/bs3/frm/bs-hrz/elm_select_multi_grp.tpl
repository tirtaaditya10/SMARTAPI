<div class="form-group">
	<label class="control-label col-md-3">{$dtx.elm_label}</label>
	<div class="col-md-9">
		<select id="{$dtx.col_fid}_{$sys.req.rid}" name="{$dtx.col_fid}" class="multiSelect_grp" multiple="multiple"
		        {if isset($disabled)}disabled{/if}
				{if $dtx.elm_label}title="{$dtx.elm_label}" data-placeholder="{$dtx.elm_label}"{/if}
				{if $dtx.is_require}required data-rule-required="true" data-msg-required="{$dtx.msg_required|default:'This column is mandatory !'}"{/if}
		>
			{html_options options=$dtx.option selected=$dtx.sp_def}

		</select>
	</div>
</div>