# ohshaker
Please add comments when code gets complex so that someone else knows what the function does.


## Git Strategy 

Make branches per feature or bug. Naming should be as following:
- feature/featureName
- bug/IssueNumber/bugName

When you create a branch, make sure you base it off the current master:
```
GIT CHECKOUT MASTER
GIT PULL
GIT CHECKOUT -B featureOrBug/yourBranch
```

Always commit once you have got something working. This works as a backup in case you lost your device or you want to revert to the a previous stage. 

To see which files have been modified:
```
GIT STATUS
```
To a add file to git:
```
GIT ADD filename
```
To commit added files"
```
GIT commit -m "What you have changed"
```
To commit all changes:
```
GIT COMMIT -AM "What you have changed"
```

Always push before you turn off your computer or switch branches.
First time you push use: 
```
$ GIT PUSH origin nameOfYourBranch
```
From there on you can simply write:
```
GIT PUSH
```

Avoid commiting in the master branch directly. If something is not working, create an issue on Github. 
https://github.com/ph00lt0/ohshaker/issues

Avoid directly merging of your own branches. Make a pull request and ask (assign with github) someone else to look through your changes. When it is marked as approved you can proceed merging or let someone else do it.

Never commit in master or merge in master locally. 

In case of a complicated merge conflict, sit down together with the other contributer.

Before making a pull request always merge in the lastest master in your current branch and test all Functionality. So 
```
GIT CHECKOUT MASTER
GIT PULL
GIT CHECKOUT featureOrBug/yourBranch
GIT MERGE MASTER
```
Then if there any merge conflicts resolve them. Next test all Functionality. If everything is okay:
```
GIT COMMIT -AM "Merged master into yourBranch"
GIT PUSH
```

If you want to sync all branches use:
```
git fetch
```

