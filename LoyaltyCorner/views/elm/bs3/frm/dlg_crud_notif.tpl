{** P: Priviledge
    R: View (Read) Only
**}
{if !isset($P)}{assign "P" 0}{/if}
{if !isset($R)}{assign "R" 0}{/if}
{if !isset($T)}{assign "T" 0}{/if}
{if !isset($M)}{assign "M" 0}{/if}
{if $M || $P || $R || $T}
<div class="alert alert-warning fade in margin-top-30">
    <strong>ATTENTION !</strong>
    {if $P}<p class="txt-color-purple bold no-space">You don't have sufficient permission to modify this content at current stage</p>{/if}
    {if $R}<p class="txt-color-red bold  no-space">This content is in read-only mode now !!!</p>{/if}
    {if $T}<p class="txt-color-blue no-space">{$T}</p>{/if}
    {if $M}Field with <span class="txt-color-red">(*)</span> sign is mandatory<br />{/if}
</div>
{/if}
