# lutece6
I'm working on this project : 
A plateform dedicated to beginners in web development, where you can create a project, recruit collaborators.


First Version:

<img src="https://raw.githubusercontent.com/dev-dl/lutece6/master/images_readme/developerPage.jpg" width="600" >

## Using :
PHP framwork : Symfony 5

local database: postgreSql

## To do list:
### functionality
- [x] create developer entity class and the database
- [x] compute slug 
  - [x] slug = lastName + firstName or emailadress (if lasName & firstName == null)
  - [ ] update slug (after adding lastName and firstName)
- [x] developer personal page
- [ ] deployment
  - [ ] PaaS
    - [ ] <s>Symfony cloud</s> ->too expensive
    - [ ] <s>Platform.sh</s> -> Platform don't support docker, need to know more about PaaS
- [x] register form
- [x] login form
- [ ] edit profil page

### database
- [x] developer and developer_auths
  - [x] developer : user informations : lastName, firstName, profilImageName, description
  - [x] developer_auths : developerId, password, login with googlemail, facebook etc
- [ ] project
- [ ] activity



Books reading
- [x] Programming for PaaS - Lucas Carlson
- [ ] Designing Data-Intensive Applications - Martin Kleppmann
 

What it looks like now :
https://github.com/dev-dl/symfony_project_lutece/tree/master/images_readme
