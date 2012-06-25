<?php

session_start();
require_once ('../connections/connection.php');
include ("../includes/config.php"); # config file with variables (required)
include("../includes/admin.php");
include("../functions.php");

$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db)
{
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($sqldb, $db);

//check if logged in
$loggedIn = ($_SESSION['recruiter'] == "LOGGED_IN");

if (!$loggedIn)
{
	header("Location: index.php");
	exit;
}

$pageTitle = "Recruiter Section";
$indirection = "../";
$includeStyle = "recruiteJS.php";
include ("../top.php"); 
?>
<form name="logOutForm" action="index.php" method="post">
<input type="submit" name="logOut" value="Log Out" />
</form> <br /><?php include 'recruiteMenu.php';?><br />

<h3>EECS Course Descriptions</h3>

<p>
Below is a list of common EECS courses. Click on a course to read a description. <br />The complete list can be found <a href="http://www.engin.umich.edu/bulletin/eecs/courses.html">here</a>.
</p>

<div id="classTitle" onclick="ChangeDIV(203)">
<strong>EECS 203</strong> - Discrete Mathematics
</div>
<div id="203desc" style="padding-top: 5px; display: none">
Introduction to the mathematical foundations of computer science. Topics covered include: propositional and predicate logic, set theory, function and relations, growth of functions and asymptotic notation, introduction to algorithms, elementary combinatorics and graph theory, and discrete probability theory.
</div>

<div id="classTitle" onclick="ChangeDIV(215)">
<strong>EECS 215</strong> - Introduction to Electronic Circuits
</div>
<div id="215desc" style="padding-top: 5px; display: none">
Introduction to electronic circuits. Basic Concepts of voltage and current; Kirchhoff's voltage and current laws; Ohm's law; voltage and current sources; Thevenin and Norton equivalent circuits; DC and low frequency active circuits using operational amplifiers, diodes, and transistors; small signal analysis; energy and power. Time- and frequency-domain analysis of RLC circuits. Basic passive and active electronic filters. Laboratory experience with electrical signals and circuits.
</div>

<div id="classTitle" onclick="ChangeDIV(216)">
<strong>EECS 216</strong> - Introduction to Signals and Systems
</div>
<div id="216desc" style="padding-top: 5px; display: none">
Theory and practice of signals and systems engineering in continuous and discrete time. Continuous-time linear time-invariant systems, impulse response, convolution. Fourier series, Fourier transforms, spectrum, frequency response and filtering. Sampling leading to basic digital signal processing using the discrete-time Fourier and the discrete Fourier transform. Laplace transforms, transfer functions, poles and zeros, stability. Applications of Laplace transform theory to RLC circuit analysis. Introduction to communications, control, and signal processing. Weekly recitations and hardware/Matlab software laboratories.
</div>

<div id="classTitle" onclick="ChangeDIV(270)">
<strong>EECS 270</strong> - Introduction to Logic Design
</div>
<div id="270desc" style="padding-top: 5px; display: none">
Binary and non-binary systems, Boolean algebra, digital design techniques, logic gates, logic minimization, standard combinational circuits, sequential circuits, flip-flops, synthesis of synchronous sequential circuits, PLAs, ROMs, RAMs, arithmetic circuits, computer-aided design. Laboratory includes  design and CAD experiments.
</div>

<div id="classTitle" onclick="ChangeDIV(280)">
<strong>EECS 280</strong> - Programming and Introductory Data Structures
</div>
<div id="280desc" style="padding-top: 5px; display: none">
Techniques and algorithm development and effective programming, top-down analysis, structured programming, testing, and program correctness. Program language syntax and static and runtime semantics. Schope, procedure instantiation, recursion, abstract data types, and parameter passing methods. Structured data types, pointers linked data structures stacks, queues, arrays, records, and trees.
</div>

<div id="classTitle" onclick="ChangeDIV(281)">
<strong>EECS 281</strong> - Data Structures and Algorithms
</div>
<div id="281desc" style="padding-top: 5px; display: none">
Introduction to algorithm analysis and O-notation; Fundamental data structures including lists, stacks, queues, priority queues, hash tables, binary trees, search trees, balanced trees and graphs; searching and sorting algorithms; recursive algorithms; basic graph algorithms; introduction to greedy algorithms and divide and conquer strategy. Several programming assignments.
</div>

<div id="classTitle" onclick="ChangeDIV(370)">
<strong>EECS 370</strong> - Introduction to Computer Organization
</div>
<div id="370desc" style="padding-top: 5px; display: none">
Basic concepts of computer organization and hardware. Instructions executed by a processor and how to use these instructions in simple assembly-language programs. Stored-program concept. Datapath and control for multiple implementations of a processor. Performance evaluation, pipelining, caches, virtual memory, input/output.
</div>

<div id="classTitle" onclick="ChangeDIV(381)">
<strong>EECS 381</strong> - Object Oriented and Advanced Programming
</div>
<div id="381desc" style="padding-top: 5px; display: none">
Programming techniques in Standard C++ for large-scale, complex, or high-performance software. Encapsulation, automatic memory management, exceptions, generic programming with templates and function objects, Standard Library algorithms and containers. Using single and multiple inheritance and polymorphism for code reuse and extensibility; basic design idioms, patterns, and notation.
</div>

<div id="classTitle" onclick="ChangeDIV(470)">
<strong>EECS 470</strong> - Computer Architecture
</div>
<div id="470desc" style="padding-top: 5px; display: none">
Basic concepts of computer architecture and organization. Computer evolution. Design methodology. Performance evaluation. Elementary queuing models. CPU architecture instruction sets. ALU design. Hardware and micro-programmed control. Nanoprogramming. Memory hierarchies. Virtual memory. Cache design. Input-output architectures. Interrupts and DMA. I/O processors. Parallel processing. Pipelined processors. Multiprocessors.
</div>

<div id="classTitle" onclick="ChangeDIV(482)">
<strong>EECS 482</strong> - Introduction to Operating Systems
</div>
<div id="482desc" style="padding-top: 5px; display: none">
Operating system design and implementation: multi-tasking; concurrency and synchronization; inter-process communication; deadlock; scheduling; resource allocation; memory and storage management; input-output; file systems; protection and security. Students write several substantial programs dealing with concurrency and synchronization in a multi-task environment, with file systems, and with memory management.
</div>

<div id="classTitle" onclick="ChangeDIV(489)">
<strong>EECS 489</strong> - Computer Networks
</div>
<div id="489desc" style="padding-top: 5px; display: none">
Protocols and architectures of computer networks. Topics include client-server computing, socket programming, naming and addressing, media access protocols, routing and transport protocols, flow and congestion control, and other application-specific protocols. Emphasis is placed on understanding protocol design principles. Programming problems to explore design choices and actual implementation issues assigned.
</div>

<div id="classTitle" onclick="ChangeDIV(492)">
<strong>EECS 492</strong> - Introduction to Artificial Intelligence
</div>
<div id="492desc" style="padding-top: 5px; display: none">
Fundamental concepts of AI, organized around the task of building computational agents. Core topics include search, logic, representation and reasoning, automated planning, decision making under uncertainty, and machine learning.
</div>

<?php
include ("../side.php");
include ("../bottom.php");
?>
