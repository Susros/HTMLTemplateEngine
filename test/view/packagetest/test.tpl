<div>
{#loop(3):<p>{$msg : "Hello World"}</p>;} Testing {$done:"DONE"}
</div>

<p>{$description}</p>

<select>
{#dup:<option value="{$val}">{$op}</option>;}
</select>

{$test:"TESTING HERE"}