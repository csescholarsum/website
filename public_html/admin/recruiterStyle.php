
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

#addRecruiterButton:hover
{
	cursor: pointer;
}

#addRecruiterSection
{
	display: <?php if (isset($_POST['addRecruiter'])) echo "block"; else echo "none"; ?>;
	margin-bottom: 10px;
}

</style>

<script type="text/javascript">

var sectionFilled = <?php if (isset($_POST['addRecruiter'])) echo "true"; else echo "false"; ?>;

function addRecruiterClick()
{
	if (sectionFilled)
		document.getElementById("addRecruiterSection").style.display = "none";
	else
		document.getElementById("addRecruiterSection").style.display = "block";
	sectionFilled = !sectionFilled;
}

function addRecruiterOver(ptr)
{
	ptr.style.color = "#CCCCCC";
	ptr.style.cursor = "pointer";
}

function addRecruiterOut(ptr)
{
	ptr.style.color = "white";
	ptr.style.cursor = "auto";
}

</script>

