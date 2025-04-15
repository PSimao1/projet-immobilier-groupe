$branches = @("Alexis", "David", "Estelle", "Nicolas", "Noémy", "Simao", "Tory") # Mettre toute les branches

Write-Host "Liste des branches :"
git checkout main
git pull origin main

foreach ($branch in $branches) {
    Write-Host $branch
    git checkout $branch
    git merge main
    git pull origin $branch
}

Write-Host "Fin du script"
git checkout main

# Lancer avec un ./git.ps1