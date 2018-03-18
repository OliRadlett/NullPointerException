@echo off
setlocal EnableDelayedExpansion
for /f "tokens=*" %%a in ('git rev-list --left-right --count origin/master...@') do set details=%%a
echo %details%
for /f "tokens=1,2,3,4 delims= " %%a in ("%details%") do set behind=%%a &set ahead=%%b
echo %behind%
echo %ahead%
