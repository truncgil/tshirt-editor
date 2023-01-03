<?php use App\Contents; 
$title = env("APP_NAME");
$description = env("APP_DESCRIPTION");
$keywords = env("APP_KEYWORDS");

?>

@extends('admin.master')

@section("title",$title)
@section("description",$description)
@section("keywords",$keywords)


@section('content')

<div class="container">
    <script src="https://editor.truncgil.com/scripts.min.js?v35"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        document.onpaste = function(event)
        {
            var items = event.clipboardData.items;
            console.log(JSON.stringify(items)); // will give you the mime types
            var blob = items[0].getAsFile();
            var reader = new FileReader();
            reader.onload = function(event)
            {
            
                
                //truncgil.resetAndOpenEditor({image: event.target.result});
                //truncgil.close();
                var overlay = $(".editor-overlay-container").html();
                if(overlay!="") {
                    truncgil.resetAndOpenEditor({image: event.target.result});
                    $(".editor-overlay-container").html("");
                } else {
                    truncgil.openFile(event.target.result);
                }
                
                
            
                
                
                console.log(event.target.result)
            }; // data url  
            reader.readAsDataURL(blob); 
        }
        
        </script>  
    <script>
    var state = localStorage.getItem("state");
	var dark_mode = localStorage.getItem("dark_mode");
	
	console.log(state);
    //console.log(json.canvasWidth);
    var width = 0;
    if(state!=null) {
        var json = JSON.parse(state);
        width = json.canvasWidth;
    }
	if(state!="" && width!=0) {
		var truncgil = new Truncgil({
			// ENTER CONFIGURATION HERE
			// ENTER CONFIGURATION HERE
		//	image : "logo2.svg",
			crossOrigin: true,
			baseUrl: 'https://editor.truncgil.com',
			
			ui: {
				defaultTheme: dark_mode,
				
				openImageDialog: {
            		show: false
				},
				allowEditorClose: true
			},
			tools : {
				export: {
					defaultFormat: 'png',
					defaultQuality: 0.8,
					defaultName: 'Trunçgil Editor',
				},
				stickers: {
				replaceDefault: false,
				items: [
					{
						name: "TurkiyePNG",
						items: 9,
						type: "png",
						thumbnailUrl: "images/ui/turkey.svg"
					},
					{
						name: "TurkiyeSVG",
						items: 2,
						type: "svg",
						thumbnailUrl: "images/ui/turkey.svg"
					},
					{
						name: "Islami",
						items: 13,
						type: "png",
						thumbnailUrl: "images/stickers/Islami/0.png"
					},
					{
						name: "Truncgil",
						items: 7,
						type: "svg",
						thumbnailUrl: "images/ui/truncgil.svg"
					}
				]			}
			},
			onLoad: function () {
				window.postMessage('truncgilLoaded', '*');
				
					truncgil.loadState(state).then(function() {
						console.log("State is loaded");
					});
					onLoad();
				
			},
		});
	} else {
		var truncgil = new Truncgil({
			// ENTER CONFIGURATION HERE
			// ENTER CONFIGURATION HERE
		//	image : "logo2.svg",
			crossOrigin: true,
			baseUrl: 'https://editor.truncgil.com',
			ui: {
				defaultTheme: dark_mode,
				openImageDialog: {
            		show: true
				},
                
				allowEditorClose: true
			},
            tools : {
                export: {
					defaultFormat: 'png',
					defaultQuality: 0.8,
					defaultName: 'Trunçgil Editor',
				},
				stickers: {
                    replaceDefault: false,
                    items: [
					{
						name: "TurkiyePNG",
						items: 9,
						type: "png",
						thumbnailUrl: "images/ui/turkey.svg"
					},
					{
						name: "TurkiyeSVG",
						items: 2,
						type: "svg",
						thumbnailUrl: "images/ui/turkey.svg"
					},
					{
						name: "Islami",
						items: 13,
						type: "png",
						thumbnailUrl: "images/stickers/Islami/0.png"
					},
					{
						name: "Truncgil",
						items: 7,
						type: "svg",
						thumbnailUrl: "images/ui/truncgil.svg"
					}
				]                }
            },
			onLoad: function () {
				window.postMessage('truncgilLoaded', '*');
				//	console.log(state);
					truncgil.loadState(state).then(function() {
						console.log("State is loaded");
					});
				// console.log(truncgil.ui.openImageDialog);
				onLoad();
				
			},
		});
	}
	function onLoad() {
		truncgil.setConfig('ui.defaultTheme', 'light');
		
	}
	function download(filename, text) {
		var element = document.createElement('a');
		element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
		element.setAttribute('download', filename);

		element.style.display = 'none';
		document.body.appendChild(element);

		element.click();

		document.body.removeChild(element);
	}
	function saveState() {
		var state = truncgil.getState();
		var json = JSON.parse(state);
		
		if(json.canvasWidth!=0) {
			localStorage.setItem('state', state);
			//console.log(json);
			//console.log(state);

			var today = new Date();
			var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
			console.log("State is saved");
			$(".save-state").html("Kaydedildi ("+time+") ");
		}
		
	}
	var interval = window.setInterval(function(){
		saveState();
	
		
		
	},3000); 
    function reset() {
        if(confirm("Çalışmayı sıfırlamak istediğinizden emin misiniz. Bu işlem geri alınamaz")) {
			clearInterval(interval);
            localStorage.removeItem("state");
            location.reload();
        }
    }
	function darkMode() {
		var dark_mode = localStorage.getItem("dark_mode");
		if(dark_mode == "dark") {
			dark_mode = "light";
		} else {
			dark_mode = "dark";
		}
		localStorage.setItem("dark_mode",dark_mode);
		location.reload();
	}
	function saveFile() {
		var state = truncgil.getState();
		//console.log(state);
		download("Truncgil Imageditor.json",state);
	}
	/*
	try {
		navigator.clipboard.write([
			new ClipboardItem({
				'image/png': pngImageBlob
			})
			
		]);
		console.log(ClipboardItem);
	} catch (error) {
		console.error(error);
	}
*/
	
	
</script>

<script>
	$(function(){
	setTimeout(function(){
		var dark_mode = localStorage.getItem("dark_mode");
		if(dark_mode=="dark") {
			$("open-sample-image-panel h2").prepend("<img src='logo2.svg' class='logo2'>");
		} else {
			$("open-sample-image-panel h2").prepend("<img src='logo.svg' class='logo2'>");
		}
		
	},0);
	$(document).keydown(function(e) {

	var key = undefined;
	var possible = [ e.key, e.keyIdentifier, e.keyCode, e.which ];

	while (key === undefined && possible.length > 0)
	{
	key = possible.pop();
	}

	if (key && (key == '115' || key == '83' ) && (e.ctrlKey || e.metaKey) && !(e.altKey))
	{
	e.preventDefault();
	saveState();
	//alert("Ctrl-s pressed");
	return false;
	}
	return true;
	}); 
	});
</script>

<style>
	.logo2 {
		display: block;
		margin: 20px auto;
		width: 200px;
	}
	.button-with-image { 
				background: url('assets/images/canvas-bg.png') !important;
			}
</style>
    <truncgil-editor>
    </truncgil-editor>
   
</div>


@endsection

