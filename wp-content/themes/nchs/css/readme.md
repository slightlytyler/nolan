# UseLess!

# NVM Install (Installs Node/NPM)
git clone git://github.com/creationix/nvm.git ~/.nvm
printf "\n\n# NVM\nif [ -s ~/.nvm/nvm.sh ]; then\n\tNVM_DIR=~/.nvm\n\tsource ~/.nvm/nvm.sh\nfi" >> ~/.bashrc
NVM_DIR=~/.nvm
source ~/.nvm/nvm.sh

# NVM Setup
nvm install v0.10.16
nvm alias default 0.10
nvm use 0.10

npm install -g watch-less

# In wp-content/themes/nhcs/
watch-less -e .css
