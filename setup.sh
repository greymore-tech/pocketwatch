rm -rf .git
rm -rf .gitattributes
git init  
git add .
read -p " Enter Git Repo of new project: (PANToken@github.com/repoaddress)" newrepo
git remote add origin "$newrepo"
git branch -M main
read -p " Enter commit message: " commitmessage
git commit -m "$commitmessage"
git push -u origin main