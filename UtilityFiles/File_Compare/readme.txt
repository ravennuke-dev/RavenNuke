This file is provided 'as is' by Guardian (www.code-authors.com) without any warranty, implied or otherwise.

I have compared the file structure of various RavenNuke (tm) distributions against preceding versions of
RavenNuke (tm) ( starting with RN v2.3) and phpNuke versions 7.6 through to 8.1

I have noted all the differences and compiled a list of redundant files which are not required with
RavenNuke (tm) V2.4 and hard coded those files / directory paths in this script.

When you execute this script (see below) it will compare the file structure on your server and
notify you if there are any redundant files you can remove.

Wherever possible I have included messages informing you which *nuke version the redundant files came
from, whether there is a potential security issue leaving them in place etc.

I still recommend you do a full file comparison using a good file comparison program like
Beyond Compare, WinMerge, etc., but this script will certainly assist you with an 'at-a-glance'
overview of the state of your file structure.

USE
Upload the file that corresponds to the version you just installed e.g.
file_migration_2_30_00.php for RavenNuke 2.3.x
file_migration_2_40_00.php for RavenNuke 2.4.x
file_migration_2_50_00.php for RavenNuke 2.5.x
to your RavenNuke(tm) root and navigate to it through your browser i.e.
www.yoursite.com/file_migration_2_50_00.php

UPDATES
This file will be updated with each RavenNuke (tm) release.
If you are migrating from something other than RavenNuke (tm) or phpNuke, please post in my forums at
www.code-authors.com and I will try to add additional forks of phpNuke to this file as soon as I can.

Raven Web Services (tm) LLC
2013-02-08
