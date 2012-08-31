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

#addMemberSection
{
	display: <?php if (isset($_POST['addMember'])) echo "block"; else echo "none"; ?>;
	margin-bottom: 10px;
}


</style>

<script type="text/javascript">

var sectionFilled = <?php if (isset($_POST['addMember'])) echo "true"; else echo "false"; ?>;

function addMemberClick()
{
	if (sectionFilled)
		document.getElementById("addMemberSection").style.display = "none";
	else
		document.getElementById("addMemberSection").style.display = "block";
	sectionFilled = !sectionFilled;
}

function addMemberOver(ptr)
{
	ptr.style.color = "#CCCCCC";
	ptr.style.cursor = "pointer";
}

function addMemberOut(ptr)
{
	ptr.style.color = "white";
	ptr.style.cursor = "auto";
}

</script>