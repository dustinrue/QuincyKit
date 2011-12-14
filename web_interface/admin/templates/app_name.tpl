{include "header.tpl"}
<body>
<div id="container" class="container prepend-top append-bottom">
<h1>CrashReporter Admin Interface</h1>
<h2><a href="/admin/app_name">Apps</a></h2>
<table>
  <colgroup>
    <col width="230">
    <col width="200">
    <col width="200">
    <col width="150">
    <col width="150">
  </colgroup>
  <tr>
    <th>Bundle identifier / Name</th>
    <th>Email - / Push Notifications</th>
    <th>Issue Tracker / HockeyApp</th>
    <th>Crashes</th>
    <th>Actions</th>
  </tr>
</table>



<form name='add_app' action='/admin/app_name/add' method='post' id="add_app">
<table>
  <colgroup>
    <col width="230">
    <col width="200">
    <col width="200">
    <col width="150">
    <col width="150">
  </colgroup>
  <tr align='center'>
    <td>
      <input type='text' name='bundleidentifier' size='25' maxlength='50' placeholder='com.yourcompany.appidentifier'>
      <input type='text' name='name' size='25' maxlength='250' placeholder='Application Name'>
    </td>
    <td class='message'>
      <input type='text' name='emails' size='25' maxlength='250' placeholder=', separated email addresses'><br>
      <input type='text' name='pushids' size='25' maxlength='250' placeholder='max. 5 , separated Prowl IDs'>
    </td>
    <td>
      <input type='text' name='issuetrackerurl' size='25' maxlength='4000' placeholder='%subject% %description%'><br>
      <input type='text' name='hockeyappidentifier' size='25' maxlength='4000' placeholder='HockeyApp Public Identifier'>
    </td>
    <td>
      <select name='symbolicate'>
        <option value="0" selected>Don't symbolicate</option>
        <option value="1">Symbolicate</option>
      </select><br>
    </td>
    <td>
      <button type='submit' class='button'>Create new App</button>
    </td>
  </tr>
</table>
</form>



{foreach $apps as $currentapp}
<form name='update4' action='/admin/app_name/update/{$currentapp->appID()}' method='post' id="update{$currentapp->appID()}">
<input type='hidden' name='id' value='{$currentapp->appID()}'>
<table>
  <colgroup>
    <col width="230">
    <col width="200">
    <col width="200">
    <col width="150">
    <col width="150">
  </colgroup>

  <tr align='center'>
    <td>
      <a href='app_versions.php?bundleidentifier={$currentapp->bundleIdentifier()}' placeholder='com.yourcompany.appidentifier'>{$currentapp->bundleIdentifier()}</a><br>
      <input type='text' name='name' size='25' maxlength='250' value='{$currentapp->name}' placeholder='Application Name'>
    </td>
    <td class='message'>
      <input type='text' name='emails' size='25' maxlength='250' placeholder='; separated email addresses' value='{$currentapp->emails()}'><br>
      <input type='text' name='pushids' size='25' maxlength='250'placeholder='max. 5 , separated Prowl IDs' value='{$currentapp->pushIDs()}'>
    </td>
    <td>
      <input type='text' name='issuetrackerurl' size='25' maxlength='4000' value='{$currentapp->issueTrackerURL()}' placeholder='%subject% %description%'><br>
      <input type='text' name='hockeyappidentifier' size='25' value='{$currentapp->hockeyAppIdentifier()}' maxlength='4000' placeholder='HockeyApp Public Identifier'>
    </td>
    <td>
      <select name='symbolicate' onchange='javascript:document.update{$currentapp->appID()}.submit();'>
        <option value="0">Don't symbolicate</option>
        <option value="1" {if $currentapp->symbolicate() == 1} selected{/if}>Symbolicate</option>
      </select><br>
      {assign var="bundleid" value=$currentapp->bundleIdentifier()}
      {$numberOfCrashes.$bundleid}
    </td>
    <td>
      <button class='button' type='submit'>Update</button> <a href='/admin/app_name/delete/{$currentapp->appID()}' class='button redButton' onclick='return confirm("Do you really want to delete this item?");'>Delete</a>
    </td>
</tr>
{/foreach}
</table>
</form>
</div>
</body>
</html>
