<style>
	#js_warn span { margin-left:400px; color: #222222; font: 18px Tahoma, Helvetica; text-shadow: 0 2px 3px #555555; }
	#js_warn p	 { margin-left:400px; margin-right:20px; font-size: 14px; text-emphasis:#a32407; color:#b61e2d; text-shadow: 0 7px 11px #390; }
</style>
<div id="js_warn" style="height:400px; background:url({$sys.cfg.asset}app/page/img/warning/javascript-disabled.png) 20px 60px no-repeat;">
	<br /><br /><br />
	<span>{$sys.cfg.agent.name}'s Javascript is Disabled !!!</span>
	<p>
        In order to run properly, this application needs javascript enabled.
        Please activate javascript in your browser.<br /><br />
		Contact your administrator if you don't know how enable it.<br />
        {if $sys.cfg.agent.name eq 'Firefox'}
        {elseif $sys.cfg.agent.name eq 'Mozilla'}
        {elseif $sys.cfg.agent.name eq 'Gekco'}
        {elseif $sys.cfg.agent.name eq 'Internet Explorer'}
        {elseif $sys.cfg.agent.name eq 'Opera'}
        {elseif $sys.cfg.agent.name eq 'Safari'}
        {elseif $sys.cfg.agent.name eq 'Chrome'}
        {else}
        {/if}
	</p>
</div>
