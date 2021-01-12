<?php
include('../modules/lib.php');

error_reporting(E_ALL);
ini_set("display_errors", 1);

    if (!isAdmin()) {
        die('Only admins can access this page.');
    }
    //include '_header.php';
     

?>


    <script type="text/javascript">
    var selClass;
    var mouseDown    = false;
    var cells_across = 25;
    var cells_down   = 25;
    var blockObjs = [
    new newBlock('yellowBg'   , 0, 'Non Walkable'),
    new newBlock('greenBg'    , 1, 'Grass'),
    new newBlock('blueBg'     , 2, 'Water'),
    new newBlock('redBg'      , 3, 'Lava')
    ];
     
    function newBlock(className, blockValue, content) {
    this.className  = className;
    this.blockValue = blockValue;
    this.content   = content;
    }
     
    function hasClass(ele,cls) {
    return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
    }
     
    function addClass(ele,cls) {
    if (!this.hasClass(ele,cls)) ele.className += " "+cls;
    }
     
    function removeClass(ele,cls) {
    if (hasClass(ele,cls)) {
    var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
    ele.className=ele.className.replace(reg,' ');
    }
    }
     
     
     
    function setClass(className, element) {
    // remove the selected class from all of the buttons
    elements = document.querySelectorAll('#picker div');
    for (var i=0; i<elements.length; i++) {
    removeClass(elements[i], 'selected');
    }
     
    // select the class that we just clicked
    selClass = className;
    addClass(element, 'selected');
    }
     
    // sets the color of a cell
    function colorInCell(element) {
    removeAllBackground(element);
    addClass(element, selClass);
    }
     
    // is called when we hover our mouse over a table cell
    function hoverOverCell(element) {
    if (mouseDown) {
    colorInCell(element);
    } else {
    addClass(element, selClass+'Temp');
    }
    }
     
    // remove all of the temp backgrounds that hovering causes
    function removeTempBackground(element) {
    for (var i=0; i<blockObjs.length; i++) {
    removeClass(element, blockObjs[i].className+'Temp');
    }
    }
     
    // fucntion name says it all
    function removeAllBackground(element) {
    removeTempBackground(element);
     
    for (var i=0; i<blockObjs.length; i++) {
    removeClass(element, blockObjs[i].className);
    }
    }
     
    // show us the map in a 3d javascript array
    function getJavascript() {
    var rows = document.getElementsByTagName('tr');
    var output = 'var map = [';
    var cells, pArray, cell;
     
    for (var i=0; i<25; i++) {
    cells = rows[i].getElementsByTagName('td');
    pArray = [];
     
    for (var j=0; j<25; j++) {
    cell = cells[j];
     
    for (var k=0; k<blockObjs.length; k++) {
    if ( hasClass(cell, blockObjs[k].className) ) {
    pArray.push(blockObjs[k].blockValue);
    break;
    }
    }
     
    }
    output += '\n\t[' + pArray.join(', ') + '],';
    }
    output = output.substring(0, output.length-1) + '\n]';
     
    document.getElementsByTagName('textarea')[0].innerHTML = output;
    }
     
    function fillMap() {
    var rows = document.getElementsByTagName('tr');
     
    for (var i=0; i<25; i++) {
    cells = rows[i].getElementsByTagName('td');
    for (var j=0; j<25; j++) {
    colorInCell(cells[j]);
    }
    }
    }  
	
    function changeMap() {
	e.preventDefault();
	var mapNum = document.getElementById("mapNum");
	var table = document.getElementByTagName("table");
	table.style.background = "../images/maps/new/"+mapNum+".png";
    }
     
    // adds a table with a cell for
    // every spot a player could step
    function addMainTable() {
    var table = document.createElement('table');
    var row, datacell;
     
    for (var i=0; i<cells_down; i++) {
    row = document.createElement('tr');
     
    for (var j=0; j<cells_across; j++) {
    datacell = document.createElement('td');
    datacell.innerHTML = '&nbsp;';
     
    datacell.addEventListener('click'     , function () { colorInCell(this);          }, false);
    datacell.addEventListener('mouseover' , function () { hoverOverCell(this);        }, false);
    datacell.addEventListener('mouseout'  , function () { removeTempBackground(this); }, false);
     
    row.appendChild(datacell);
    }
    table.appendChild(row);
    }
     
    document.body.insertBefore(table, document.getElementById('jCode').previousSibling);
    }
     
    // adds the buttons at the top of the page
    function addButtons() {
    // where we are going to put them
    var pickertag = document.getElementById('picker');
     
    // add them all
    for (var i=0; i<blockObjs.length; i++) {
    // make the div tag
    var divtag = document.createElement('div');
    addClass(divtag, blockObjs[i].className);
    divtag.innerHTML = blockObjs[i].content;
     
    // add the onclick event
    divtag.addEventListener('click' , (function(i) {
    return function () {
    setClass(blockObjs[i].className, this);
    }
    }(i)), false);
     
    pickertag.insertBefore(divtag, pickertag.firstChild);
    }
    }
     
    window.addEventListener('load'     , function() { addButtons(); addMainTable(); } , false);
    window.addEventListener('mouseup'  , function() { mouseDown = false; }, false);
    window.addEventListener('mousedown', function() { mouseDown = true;  }, false);
     
     
     
    </script>
    <style>
    * {
    margin-left: auto;
    margin-right: auto;
    }
     
    table {
    background-image:url('http://localhost/images/maps/new/5.png');
    background-repeat: no-repeat;
    border-collapse: collapse;
    border: none;
     
    margin-top: 50px;
    margin-bottom: 50px;
     
    clear: both;
    }
     
    td {
    font-size: 1px;
    width: 14px;
    height: 16px;
    opacity:0.5;
    }
     
    .redBgTemp, .redBg {
    background-color: #FF0000;
    }
     
    .blueBgTemp, .blueBg {
    background-color: #0044FF;
    }
     
    .greenBgTemp, .greenBg {
    background-color: #00FF00;
    }
     
    .yellowBgTemp, .yellowBg {
    background-color: #FFFF00;
    }
     
    .getJavascript, .fillMap {
    background-color: #acfcac;
    color: #000000;
    border: 1px solid #005500;
    width: 250px;
    text-align: center;
    padding: 2px;
    margin-bottom: 10px;
    }
     
    textarea {
    width: 80%;
    height: 50%;
    border: 1px solid black;
    margin-bottom: 50px;
    margin-left: 10%;
    }
     
    #picker div {
    display: block;
    width: 150px;
    color: #000;
    padding: 2px;
    margin-left: 2px;
    text-align: center;
    float: left;
    }
     
    .selected {
    margin-top: 10px;
    }
    </style>
    </head>
     
    <div id="picker" style="width: 626px;"></div>
     

    <div id="jCode">
	</br>
	</br>
	<label for="mapNum">Map Num</label>
	<input type="text" name="mapNum" id="mapNum">
    <div class="fillMap" onclick="changeMap()">Load Map</div>
    <div class="fillMap" onclick="fillMap()">Fill Map With Selected</div>
    <div class="getJavascript" onclick="getJavascript()">Get Javascript Code</div>
    <textarea></textarea>
    </div>


