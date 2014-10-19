<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script type="text/javascript">

			var context = new webkitAudioContext();
			var analyser = context.createAnalyser();
			var mouthheight = 43;
			var steps = (200 / mouthheight);

			window.audio = new Audio();
			audio.src = 'hastalavista-baby.mp3';
			audio.controls = true;

			function gogoanalyze() {
				var freqByteData = new Uint8Array(analyser.frequencyBinCount);
				analyser.getByteFrequencyData(freqByteData);
				
				var total = 0, average = 0;
				for (i=0; i < freqByteData.length; i++) {
					total += freqByteData[i];
				}

				average = (total / freqByteData.length);

				mouth.attr("y", (450 + (average / steps)));

				window.webkitRequestAnimationFrame(gogoanalyze);
			}

			function onLoad() {
				var paper = Raphael(50, 50, 591, 600);
				var arnie = paper.image("arnie.jpg", 0, 0, 591, 600);
				window.mouth = paper.image("arnie-mouth.png", 174, 450, 149, 43);

				var source = context.createMediaElementSource(audio);
				source.connect(analyser);
				analyser.connect(context.destination);

				gogoanalyze();
			}

			window.addEventListener('load', onLoad, false);
		</script>
		<style type="text/css">
		#playlink {
			display: absolute;
			left: 600px;
		}
		</style>
    </head>
    <body>
    	<a id="playlink" href="#" onclick="audio.play();">click me</a>
    </body>
</html>