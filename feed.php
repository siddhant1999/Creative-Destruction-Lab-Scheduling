<html>
  <head>
    <!--
        === Remove google's feed script ===
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    -->

    <!-- === Add this script === -->
    <script type="text/javascript" src="https://rss2json.com/gfapi.js"></script>

    <script type="text/javascript">

    google.load("feeds", "1");

    function initialize() {
      var feed = new google.feeds.Feed("https://news.ycombinator.com/rss");
      feed.load(function(result) {
        if (!result.error) {
          var container = document.getElementById("feed");
          for (var i = 0; i < result.feed.entries.length; i++) {
            var entry = result.feed.entries[i];
            var div = document.createElement("div");
            div.appendChild(document.createTextNode(entry.title));
            container.appendChild(div);
          }
        }
      });
    }
    google.setOnLoadCallback(initialize);

    </script>
  </head>
  <body>
    <div id="feed"></div>
  </body>
</html>