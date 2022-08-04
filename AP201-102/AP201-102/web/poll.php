<?php
/*
=================================================================
Ajax Poll v1.02.200 ( includes 'Permission Check Patch' ) 
Copyright (c) PhpKobo.com ( http://www.phpkobo.com/ )
Email : admin@phpkobo.com
ID : AP201-102

This software is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; version 2 of the
License.
=================================================================
*/

//-- [BEGIN] Check permissions on poll_result.txt
$path = dirname(__FILE__) . "/poll_result.txt";
if ( !is_readable( $path ) )
{
	$msg = "ERROR: " .
		"[Ajax Poll] could not read [poll_result.txt]. " .
		"Give read permisson to [poll_result.txt].";
	echo "document.write('{$msg}');alert('{$msg}');";
	die;
}

if ( !is_writeable( $path ) )
{
	$msg = "ERROR: " .
		"[Ajax Poll] could not write [poll_result.txt]. " .
		"Give write permisson to [poll_result.txt].";
	echo "document.write('{$msg}');alert('{$msg}');";
	die;
}
//-- [END] Check permissions on poll_result.txt

function currentPageURL()
{
	$pageURL = 'http';

	if (( isset($_SERVER["HTTPS"]) ) && ( $_SERVER["HTTPS"] == "on" ))
	{
		$pageURL .= "s";
	}
	$pageURL .= "://" . $_SERVER["SERVER_NAME"];

	if ($_SERVER["SERVER_PORT"] != "80")
	{
		$pageURL .= ":" . $_SERVER["SERVER_PORT"];
	}

	$pageURL .= $_SERVER['PHP_SELF'];

	return $pageURL;
}

function getDirName()
{
	$path_parts = pathinfo( currentPageURL() );
	return $path_parts['dirname'];
}

function processVote( $vote )
{
	if ( $vote == -1 )
	{
		include( dirname(__FILE__) . "/tpl.vote.html" );
		die;
	}

	global $items;
	global $total;

	//-- get content of textfile
	$path = dirname(__FILE__) . "/poll_result.txt";

	$handle = fopen( $path, "r+");

	//-- do an exclusive lock
	if ( flock( $handle, LOCK_EX ) )
	{
		$txt = fread( $handle, filesize( $path ) );
		$items = explode( ",", $txt );

		if ( $vote >= 0 )
		{
			$vote--;
			$items[$vote]++;

			//-- truncate file
			fseek( $handle, 0 );
			ftruncate( $handle, 0 );

			//-- insert votes to txt file
			$txt = implode( ",", $items );
			fwrite( $handle, $txt );
		}

		//-- release the lock
		flock( $handle, LOCK_UN );
	}
	else
	{
	    echo "Couldn't get the lock!";
	    die;
	}
	fclose($handle);

	$total = 0;
	foreach( $items as $n )
	{
		$total += $n;
	}

	include( dirname(__FILE__) . "/tpl.result.html" );
}

function countVoteItem()
{
	$path = dirname(__FILE__) . "/poll_result.txt";
	$handle = fopen( $path, "r+");
	$txt = fread( $handle, filesize( $path ) );
	$cnt = count( explode( ",", $txt ) );
	fclose($handle);
	return $cnt;
}

function getPercent( $idx )
{
	$idx--;
	global $items;
	global $total;
	if ( $total == 0 ) return 0;
	return ( 100 * round( $items[$idx] / $total, 2 ) );
}

function getWidth( $idx )
{
	$idx--;
	global $items;
	global $total;
	if ( $total == 0 ) return 0;
	return ( 100 * round( $items[$idx] / $total, 2 ) );
}

function displayBar( $idx, $height, $color )
{
	$width = getWidth( $idx );
	return "<div id='poll_bar_{$idx}' " .
		"style='display:none;width:{$width}px;height:{$height}px;background-color:{$color};'>" .
		"</div>";
}

function getCount( $idx )
{
	$idx--;
	global $items;
	return sprintf( "%d", $items[$idx] );
}

if ( isset( $_REQUEST['vote'] ) )
{
	processVote( $_REQUEST['vote'] );
	die;
}

?>

var xmlhttp;

function onVote()
{
	var f = document.getElementById( "poll_form" );
	var a = f.answer;
	var sel = -2;
	for ( var i = 0; i < a.length; i++ )
	{
		if ( a[i].checked)
		{
			sel = a[i].value;
		}
	}

	if ( sel > 0 )
	{
		getVote( sel );
	}
	else
	{
		getVote( -2 );
	}
	return false;
}

function onView()
{
	getVote( -2 );
	return false;
}

function onBack()
{
	getVote( -1 );
	return false;
}

function getVote( int )
{
	xmlhttp=GetXmlHttpObject();
	if ( xmlhttp == null )
	{
		alert ("Browser does not support HTTP Request");
		return;
	}
	var url = "<?php echo currentPageURL(); ?>";
	url = url + "?vote=" + int;
	url = url + "&sid=" + Math.random();
	xmlhttp.onreadystatechange = stateChanged;
	xmlhttp.open( "GET", url, true );
	xmlhttp.send( null );
}

function stateChanged()
{
	if ( xmlhttp.readyState == 4 )
	{
		document.getElementById( "poll" ).innerHTML = xmlhttp.responseText;

		var max_idx = <?php echo countVoteItem(); ?>;
		for( var i = 1; i <= max_idx; i++ )
		{
			var bar = $( '#poll_bar_' + i );
			var w = bar.css( 'width' );
			bar.css( 'width', 0 );
			bar.show();
			bar.animate({
				width: w
			}, 1000 );
		}
	}
}

function GetXmlHttpObject()
{
	var objXMLHttp=null;
	if ( window.XMLHttpRequest )
	{
		objXMLHttp = new XMLHttpRequest();
	}
	else if ( window.ActiveXObject )
	{
		objXMLHttp = new ActiveXObject( "Microsoft.XMLHTTP" );
	}
	return objXMLHttp;
}

$(document).ready( function()
{
	getVote( -1 );
});

