#!/bin/csh -f


if ($?prompt) then

# Default pager
	setenv PAGER less

# Options for pager
	setenv LESS 'sM'

# Additional places to look for manual pages
# NOTE: put a colon between each entry.  Example: ~/man:/usr/share/man
	setenv extraman /usr/share/man

# Default printer
	setenv PRINTER 3128pub

# File permissions setting.  This (077) sets up your environment so that every
# time you create a file it has -rw------ permissions set (Just the owner can
# read and write the file).
        umask 077

# define TERM_NETWORK if not already defined (default network terminal type)
	if ( ! $?TERM_NETWORK ) then
		set TERM_NETWORK = 'vt100'
	endif

# Check to find which tty we're logged into
	setenv TTYTYPE `tty`

# Check the TERM variable for special case terminal types
# Redefine TERM to unknown if it is a special case
#	switch ($TERM)
#	case dialup:
#	case dumb:
#	case network:
#	case unknown:
#		setenv TERM unknown
#		breaksw
#	endsw

# Setting up the terminal
#	if (("$TERM" == unknown) || ("$TTYTYPE" == /dev/display)) then
#		set noglob
#		eval `/usr/ucb/tset -s -Q -m "unknown:?${TERM_NETWORK}"`
#		unset noglob
#	else
#		set noglob
#		eval `/usr/ucb/tset -Q -I -s`
#		unset noglob 
#	endif
#	set term=$TERM
#	unset TERM_NETWORK TTYNAME
#endif

	set term=xterm
