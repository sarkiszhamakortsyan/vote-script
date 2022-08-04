<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajax Poll Script v3.18 [ GPL ]
// Copyright (c) phpkobo.com ( http://www.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : APSMX-318
// URL : http://www.phpkobo.com/ajax_poll.php
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

//----------------------------------------------------------------
// <style>
//----------------------------------------------------------------
$style=<<<_EOM_
<style>
/* [BEGIN] CSS Reset */
.%tclass% tbody,
.%tclass% tfoot,
.%tclass% thead,
.%tclass% tr,
.%tclass% th,
.%tclass% td {
	margin:0;
	padding:0;
	border:0;
	font-size:100%;
	font-style:normal;
	font-weight:normal;
	vertical-align:middle;
	background-color:transparent;
	box-shadow:none;
}
.%tclass% img {
	margin:0;
	padding:0;
	border:0;
	background-color:transparent;
	box-shadow:none;
}
.%tclass% table {
}
.%tclass% label {
	margin:2px 0;
	font-style:normal;
	font-weight:normal;
}
.%tclass% button {
	color:black;
}
/* [END] CSS Reset */

.%tclass%,
.%tclass% button {
	font-family: "Verdana", "Arial", "Helvetica", "serif";
}

.%tclass% {
	box-sizing:content-box;
	position:relative;
	overflow:hidden;
}

.%tclass% .poll-inner {
	position:relative;

	margin:20px;
	margin-bottom:0;
	padding:0;
	font-size:16px;
	color:black;
	letter-spacing:normal;
	line-height: normal;
	word-spacing: 0px;
}

.%tclass% .poll-form {
	margin:0;
}

.%tclass% .poll-title {
	margin-bottom:20px;
	padding:0;
	text-align:center;

	color:black;
	font-weight:bold;
	font-size:18px;
	line-height:18px;
}

.%tclass% .poll-table {
	margin:0 auto;
	border-collapse:collapse;
}

.%tclass% .poll-table tr {
}

.%tclass% .poll-table td {
	margin:0;
	padding:0;
	font-size:16px;
	color:black;
	*border:1px solid transparent;
	vertical-align:middle;
}

.%tclass% .poll-table td.poll-caption-cont {
	padding:10px;
	padding-right:0;
}

.%tclass% .poll-bar {
	display:none;
	width:0;
	height:12px;
	background-color:rgba(0,128,0,0.5);

	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-khtml-border-radius: 4px;
	border-radius: 4px;
}

.%tclass% .poll-button {
	margin:0 0 3px 0;
	font-size:16px;
	width:140px;
}

.%tclass% .poll-button:focus {
	outline: 0;
}

.%tclass% .poll-time-msg {
	color:#888;
	text-align:center;
	font-weight:bold;
	margin-bottom:20px;
	padding:3px 0;

	border:1px solid #888;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	-khtml-border-radius: 3px;
	border-radius: 3px;
}

.%tclass% .ap-clear-block {
	position:absolute;
	right:15px;
	top:0px;
	height:18px;
	color:black;
	font-size:12px;
	background-color:#eee;
	border:1px solid #aaa;
	border-radius:4px;
	cursor:pointer;
}

/*-- tipbox --*/
.%tclass% .poll-tipbox {
	box-sizing:content-box;
	z-index:10000;
	display:none;
	position:absolute;
	top:0;
	left:0;
	margin:0;
	padding:0
	background-color:yellow;
}
.%tclass% .poll-tipbox .poll-tipbox-selectone,
.%tclass% .poll-tipbox .poll-tipbox-havevoted,
.%tclass% .poll-tipbox .poll-tipbox-thankyou {
	margin:0;
	padding:10px 15px;

	text-align:center;
	font-size:16px;
	font-weight:normal;
	font-style:normal;

	color:#fff;
	background-color:#080;
	border:0 solid #cfcfcf;
	border-width:5px 0;

	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
}
.%tclass% .poll-tipbox .poll-tipbox-selectone {
	background-color:rgba(0,0,0,0.6);
}
.%tclass% .poll-tipbox .poll-tipbox-havevoted {
	background-color:rgba(255,0,0,0.8);
}
.%tclass% .poll-tipbox .poll-tipbox-thankyou {
	background-color:rgba(0,128,0,0.8);
}

/*-- checkbox --*/
.%tclass% .poll-input {
	display:none;
}
.%tclass% .poll-input-cont {
	position:relative;
	display:inline-block;
	*zoom:1;
	*display:inline;
	margin:0;
	padding:0;
	width:35px;
	height:35px;
	border-radius:5px;
	vertical-align:middle;
	text-align:center;
	cursor:pointer;
	background-color:#eee;
}
.%tclass% .poll-input-inner {
	margin:10%;
	padding:0;
	width:80%;
	height:80%;
	background-color:#eee;
	border-radius:2px;
}
.%tclass% .poll-input-cont-on,
.%tclass% .poll-input-inner-on {
	background-color:#888;
}
.%tclass% .poll-input-mark {
	pointer-events:none;/* for IE11 */
	width:100%;
	height:100%;
	visibility:hidden;
}
.%tclass% .poll-input-mark-on {
	visibility:visible;
}
.%tclass% .poll-input-img {
	display:none;
}
</style>
_EOM_;
$this->addStyle($style);

?>
