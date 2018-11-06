import subprocess
import os
import shutil
import stat

def command(cmd):

    subprocess.call(cmd, shell=True)

def command_out(cmd):

    return subprocess.check_output(cmd, shell=True).decode("utf-8")

def remove_readonly(func, path, _):
    os.chmod(path, stat.S_IWRITE)
    func(path)

hashes = []

print("NullPointerException archiver")
print("Press enter to continue...")
input()
print("Downloading repository")
command("git clone https://github.com/OliRadlett/nullpointerexception")
print("Downloading commit hashes")
os.chdir("nullpointerexception")
command("git log --all --oneline > ../hashes")
os.chdir("../")

with open("hashes") as f:

    for line in f:

        hashes.append(line[0:7])

shutil.rmtree("nullpointerexception", onerror=remove_readonly)

print ("Downloading versions...")

for commit in hashes:

    command("git clone https://github.com/OliRadlett/nullpointerexception")
    os.chdir("nullpointerexception")
    command("git reset --hard "  + str(commit))
    print("Downloaded commit " + str(commit))
    os.chdir("../")
    shutil.move("nullpointerexception", str("Commit " + commit))
    print("Created archive of commit " + str(commit) + " at " + os.getcwd() + "\Commit " + commit)

shutil.rmtree("nullpointerexception", onerror=remove_readonly)
