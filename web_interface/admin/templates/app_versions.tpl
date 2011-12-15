{include "header.tpl"}
{literal}
<div id="container" class="container prepend-top append-bottom">
<h1>CrashReporter Admin Interface</h1>
<h2><a href="/admin/app_name">Apps</a> - <a href=
"app_versions.php?bundleidentifier=com.dustinrue.ControlPlane">com.dustinrue.ControlPlane</a></h2>
<table>
  <colgroup>
    <col width="320">
    <col width="320">
    <col width="320">
  </colgroup>
  <tr>
    <th>Platform Overview</th>
    <th>Crashes over time</th>
    <th>System OS Overview</th>
  </tr>
  <tr>
    <td>
      <div id="platformdiv" style="height:280px;width:310px;"></div>
    </td>
    <td>
      <div id="crashdiv" style="height:280px;width:310px;"></div>
    </td>
    <td>
      <div id="osdiv" style="height:280px;width:310px;"></div>
    </td>
  </tr>
</table>


<table>
  <colgroup>
    <col width="950">
  </colgroup>
  <tr>
    <th>Group Details</th>
  </tr>
  <tr>
    <td>
      <form name="search" action="crashes.php" method="get" id="search">
      <input type="hidden" name="bundleidentifier" value="com.dustinrue.ControlPlane"><input type="search" placeholder="Search this" name="search" size="45" maxlength="100"><br>
      <select name="type">
        <option value="0">ID</option>
        <option value="1">Description</option>
        <option value="2">Crashlog</option>
      </select><button type="submit" class="button" style="">Search</button><br></form>
    </td>
  </tr>
</table>



<table>
  <colgroup>
    <col width="220">
    <col width="80">
    <col width="120">
    <col width="80">
    <col width="80">
    <col width="80">
    <col width="160">
  </colgroup>
  <tr>
    <th>Name</th>
    <th>Version</th>
    <th>Status</th>
    <th>Notify</th>
    <th>Groups</th>
    <th>Total Crashes</th>
    <th>Actions</th>
  </tr>
</table>



<form name='add_version' action='app_versions.php' method='get' id="add_version">
<input type='hidden' name='bundleidentifier' value='com.dustinrue.ControlPlane'>
<table>
  <colgroup>
    <col width="220">
    <col width="80">
    <col width="120">
    <col width="80">
    <col width="80">
    <col width="80">
    <col width="160">
  </colgroup>
  <tr align='center'>
    <td>com.dustinrue.ControlPlane</td>
    <td>
       <input type='text' name='version' size='7' maxlength='20'></td>
    <td>
        <select name='status'>
          <option value="0">Unknown</option>
          <option value="1">In development</option>
          <option value="2">Submitted</option>
          <option value="3">Available</option>
          <option value="4">Discontinued</option>
        </select>
    </td>
    <td>
      <select name='notify' onchange='javascript:document.update.submit();'>
        <option value="0" selected>OFF</option>
        <option value="1">ALL</option>
        <option value="2">&gt; 10</option>
      </select>
    </td>
    <td><br></td>
    <td><br></td>
    <td><button type='submit' class='button'>Add Version</button></td>
  </tr>
</table>
</form>


<!-- this section loops -->
{foreach $apps as $currentapp}
<form name='update6' action='app_versions.php' method='get' id="update6">
<input type='hidden' name='id' value='6'>
<input type='hidden' name='bundleidentifier' value='com.dustinrue.ControlPlane'>
<table>
  <colgroup>
    <col width="220">
    <col width="80">
    <col width="120">
    <col width="80">
    <col width="80">
    <col width="80">
    <col width="160">
  </colgroup>
  <tr align='center'>
    <td>com.dustinrue.ControlPlane</td>
    <td>1.1.1</td>
    <td>
      <select name='status' onchange='javascript:document.update6.submit();'>
        <option value='0' selected>Unknown</option>
        <option value='1'>In development</option>
        <option value='2'>Submitted</option>
        <option value='3'>Available</option>
        <option value='4'>Discontinued</option>
      </select>
    </td>
    <td>
      <select name='notify' onchange='javascript:document.update6.submit();'>
        <option value="0" selected>OFF</option>
        <option value="1">ALL</option>
        <option value="2">&gt; 10</option>
      </select>
    </td>
    <td>0</td>
    <td>0</td>
    <td></td>
  </tr>
</table>
</form>
{/foreach}


<script type="text/javascript">
$(document).ready(function(){

    $.jqplot.config.enablePlugins = true;
    line1 = [1, 3, 19, 1, 2, 4, 2, 2, 2, 4, 1, 2, 2, 9, 1, 2, 1, 1];
    plot1 = $.jqplot('platformdiv', [line1], {
        seriesDefaults: {
                renderer:$.jqplot.BarRenderer
            },
        axesDefaults: {
          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
          tickOptions: { fontSize: '9px'}          
        },
        axes:{
            xaxis:{
                renderer:$.jqplot.CategoryAxisRenderer,
                ticks:['Macmini4,1', 'MacBookPro8,3', 'MacBookPro8,2', 'MacBookPro8,1', 'MacBookPro7,1', 'MacBookPro6,2', 'MacBookPro6,1', 'MacBookPro5,5', 'MacBookPro5,3', 'MacBookPro5,1', 'MacBookPro4,1', 'MacBookPro1,1', 'MacBookAir4,2', 'MacBookAir4,1', 'MacBookAir3,2', 'MacBook5,1', 'MacBook4,1', 'MacBook3,1'],
                tickOptions: { angle: -30}
            },
            yaxis:{
                min: 0,
                tickOptions:{formatString:'%.0f'}
            }
        },
        highlighter: {show: false}
    });
    line1 = [['2011-12-13', 5], ['2011-12-12', 5], ['2011-12-11', 7], ['2011-12-10', 5], ['2011-12-09', 4], ['2011-12-08', 5], ['2011-12-07', 8], ['2011-12-06', 8], ['2011-12-05', 4], ['2011-12-04', 3], ['2011-12-03', 1], ['2011-12-02', 4]];
    plot1 = $.jqplot('crashdiv', [line1], {
        seriesDefaults: {showMarker:false},
        series:[
            {pointLabels:{
                show: false
            }}],
        axes:{
            xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                rendererOptions:{tickRenderer:$.jqplot.CanvasAxisTickRenderer},
                tickOptions:{formatString:'%m/%d',fontSize: '9px' }
            },
            yaxis:{
                min: 0,
                tickOptions:{formatString:'%.0f'}
            }
        },
        highlighter: {show: false}
    });
    line1 = [1, 40, 18];
    plot1 = $.jqplot('osdiv', [line1], {
        seriesDefaults: {
                renderer:$.jqplot.BarRenderer
            },
        axesDefaults: {
          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
          tickOptions: { fontSize: '9px'}          
        },
        axes:{
            xaxis:{
                renderer:$.jqplot.CategoryAxisRenderer,
                ticks:['10.7.3', '10.7.2', '10.6.8'],
                tickOptions: { angle: -30}
            },
            yaxis:{
                min: 0,
                tickOptions:{formatString:'%.0f'}
            }
        },
        highlighter: {show: false}
    });
});
{/literal}
</script>
{include "footer.tpl}
