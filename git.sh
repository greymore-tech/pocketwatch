read -p " Enter commit message: " commitmessage
git add .
git commit -m "$commitmessage"
git push -u origin master
