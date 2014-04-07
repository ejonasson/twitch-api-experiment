<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StreamBuddies - Easily Watch and Share Twitch Streams</title>
	<link href="css/main.css" media="all" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="modal fade" id="user-find" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Welcome To StreamBuddies</h3>
      </div>
      <div class="modal-body">
        <p>StreamBuddies is a tool to watch the Twitch streams you or your friends follow. Enter a Twitch name below to get started.</p>
        <p>To skip this step in the future, you can bookmark your StreamBuddies page and come back to it any time.</p>
        <p>Not following anyone? Head on over to <a href="http://twitch.tv">Twitch.tv</a>, create and account, and follow some streams! Or check out who the creator of this app follows and type in "SpartanERK" below.</p>
        <p><small>Note: StreamBuddies is still in beta at this point - if you see any issues, send them to the creator on <a href="http://twitter.com/SpartanErk">twitter</a></small>.</p>

      </div>
       <div class="modal-footer">
 
		<div class="form-group pull-left">
				<form class="navbar-form" action="" method="get" role="search">
					<input type="text" class="form-modal form-control" name="name" placeholder="Find Twitch Name">
					<button type="submit" class="btn btn-default">Find</button>
				</form>	
		</div>
      </div>
    </div>
  </div>
</div>
<header>
	<div class="header-fixed">

		<h1 class = "title">StreamBuddies    <small>Always Know Who's On</small></h1>
		<div class="searchbox pull-right">
			<form class="navbar-form" action="" method="get" role="search">
				<div class="form-group">
					<input type="text" class="form-control form-box" name="name" placeholder="Find Twitch Name">
					<button type="submit" class="btn btn-default find-button">Find</button>

				</div>
				<button class = "chat-button btn btn-primary" id="chat-toggle" type="button">Toggle Chat</button>

			</form>	
		</div>
	</div>



	</header>




	<div class="wrapper">
		<div class = "main-body stream-width">
			<script type="text/template" id="stream-embed">
				<div class="stream-box">
					<h2 id="flash-header" class="flash-header"><strong>{{display_name}}</strong> currently playing: <em>{{game}}</em></h2>
					<object type="application/x-shockwave-flash" style="height:100%; width:100%;" class="flash-player" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel={{channelName}}" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=www.twitch.tv&channel={{channelName}}&auto_play=true&start_volume=25" /></object>
				</div>
			</script>
			<script type="text/template" id = "stream-chat-embed">
					<iframe frameborder="0" scrolling="no" id="chat_embed" src="http://twitch.tv/chat/embed?channel={{channelName}}&popout_chat=true" style = "height:100%; width: 270px;"></iframe>
			</script>

			<div class="streamer-list">
				<div class="show-hide-streams pull-right" id="show-hide-streams" >	
					<span class = "streamout glyphicon glyphicon-chevron-left hide-small"></span><span class = "streamin glyphicon glyphicon-chevron-right show-small"></span>
				</div>
				<div class="filter-streams">
					<h2 class="online-offline"><span class="hide-small"><span class = "glyphicon glyphicon-search"></span> 
						<input type="filter" placeholder="Filter" id="stream-filter"></span></h2>
					</div>
					<h2 class="online-offline"><span class = "glyphicon glyphicon-facetime-video"></span><span class="hide-small"> Online</span></h2>
					<script type="text/template" id="stream-lister">
						<div class="streamer" id={{channelName}}>
							<div id={{logoid}} class="stream-logo"></div>
							<div class="stream-meta"id={{metaID}}>
								<h2 class="display-name">{{display_name}}<span class="stream-viewers">{{viewerCount}}</span></h2>
								<p class="stream-status">{{status}}</p>
							</div>

						</div>
					</script>
					<script type="text/template" id="offline-stream-lister">
						<div class="streamer" id={{channelName}}>
							<div id={{logoid}} class="stream-logo grayscale"></div>
							<div class="stream-meta"id={{metaID}}>
								<h2 class="display-name">{{display_name}}</h2>
								<p class="stream-status">{{status}}</p>
							</div>

						</div>
					</script>
					<div id = "streamer-list">
						<!--Template from above prints here-->

					</div>					
					<div id="offline-list">
						<h2 class="online-offline"><span class = "glyphicon glyphicon-stop"></span><span class="hide-small"> Offline</span></h2>
					</div>
				</div>

				<div id="stream-area">
					<div class="stream-box">	
						<h2 id = "header-message" class="flash-header">Streams are loading...</h2>
						<!--Template from above prints here-->
	
					</div>
				</div>
			<div id="stream-chat-area" class="stream-chat-area">
	
			</div>

		</div>

		<!-- Template for updating stream info. Prevents removing stream from current location -->

		<script type="text/template" id="stream-refresh">
			<div id={{logoid}} class="stream-logo"></div>
			<div class="stream-meta" id={{metaID}}>
				<h2 class="display-name">{{display_name}}<span class="stream-viewers">{{viewerCount}}</span></h2>
				<p class="stream-status">{{status}}</p>
			</div>
		</script>



		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>	
		<script type="text/javascript" src="js/modal.js"></script>	
		<script type="text/javascript" src="js/handlebars-v1.3.0.js"></script>	
		<script type="text/javascript" src="js/main.min.js"></script>	
	</body>
	</html>
