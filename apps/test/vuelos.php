<script type="text/javascript" src="https://api.skyscanner.net/api.ashx?key=de77c530-d7b0-4f57-bef4-8f4876fdd56a"></script>
<script type="text/javascript">
   skyscanner.load("snippets","2");
   function main(){
       var snippet = new skyscanner.snippets.SearchPanelControl();
       snippet.setShape("box300x250");
       snippet.setCulture("es-ES");
       snippet.setCurrency("MXN");
       snippet.setMarket("MX");
       snippet.setDestination("TAM", false);
       snippet.setColourScheme("steelgreylight");
       snippet.setProduct("flights","1");
       snippet.setProduct("hotels","2");
       snippet.setProduct("carhire","3");
       snippet.setCarHireStartLocation("TAM", false);
       snippet.draw(document.getElementById("snippet_searchpanel"));
   }
   skyscanner.setOnLoadCallback(main);
</script>
<div id="snippet_searchpanel" style="width: auto; height:auto;"></div>