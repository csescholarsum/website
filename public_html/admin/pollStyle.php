<style type="text/css">

#deleteStyle
{
	background-color: #BBB;
	color: #B00;
	font-weight: bold;
}

#deleteStyle:hover
{
	background-color: #666;
	color: #B00;
	font-weight: bold;
	cursor: pointer;
}

#addpollSection
{
	display: <?php if (isset($_POST['addPoll'])) echo "block"; else echo "none"; ?>;
	margin-bottom: 10px;
}


</style>

<script type="text/javascript">

var sectionFilled = <?php if (isset($_POST['addpoll'])) echo "true"; else echo "false"; ?>;

function addPollClick()
{
	if (sectionFilled)
		document.getElementById("addPollSection").style.display = "none";
	else
		document.getElementById("addPollSection").style.display = "block";
	sectionFilled = !sectionFilled;
}

function addPollOver(ptr)
{
	ptr.style.color = "#CCCCCC";
	ptr.style.cursor = "pointer";
}

function addPollOut(ptr)
{
	ptr.style.color = "white";
	ptr.style.cursor = "auto";
}

</script>