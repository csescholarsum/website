#!/bin/csh -f
#
# This file is sourced at login time. 
# It is also sourced at other times, so be careful of what you put here.
# Also be careful of how much you put, because the more that is here, the
# longer it will take to log in.

# This 'if ($?prompt)'  statement is what keeps the rest of this file from
# being executed every time it is sourced.  (It checks to see if your prompt is
# set, and if it is then it goes on).
# Put anything you want executed 'every' time before the if statement, and
# anything else after it.

if ($?prompt) then

# Put and lines of code here that pertain only to you when you log in
# and you don't need them to be executed every time .cshrc is sourced.

# This next statement sets up a path.  It first checks to see if a path 
# exists.  If it doesn't, it builds one.  If it does, it redundantly sets
# the path equal to path.  But this is good, for the purpose of allowing you
# to add directories to your path, while still receiving the system path.
# (Note: see that ~/bin has been added.


                set path=( . /usr/ucb /bin /usr/bin /usr/sbin /usr/X11/bin /usr/X11R6/bin /usr/gnu/bin /usr/um/bin /usr/eecs/bin /usr/local/bin )


# Man pages path setting.
	setenv MANPATH "/usr/man:/usr/X11/man:/usr/gnu/man:/usr/um/man:/usr/eecs/man:/usr/local/man:/usr/lang/man"

# Environment setting for alias file if you are on A DEC.

        setenv HOSTALIASES /etc/hostaliases

# Useful short aliases

	alias m mail
	alias v vi

# Cautious aliases to reduce chances of clobbering files

	alias cp 'cp -i'
	alias mv 'mv -i'
	alias rm 'rm -i'

# Some useful flag settings.
	set notify
	set history=200
	set filec
	stty erase ^H

# set up for prompt

	unset prompt
	set prompt = "[ \! ] $cwd:t -: "
	alias cd 'cd \!* ; set prompt = "[ \! ] $cwd:t -: " '

# Some limits that can be set, they are commented out for convienence.

	limit	coredumpsize	0

endif
