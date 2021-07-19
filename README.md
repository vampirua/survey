
Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

This project crete for questionnaires of users . 

1. Need to clone project .
2. Crete server(nginx or appache) for frontend and backend . 
3. Crete db and connect in project .
4. Run migration (php yii migrate).

admin controllers : 
    /site/login - login admin
    /site/logout - logout admin
    --
    /fields/(create/update/index/view/delete) - crud fields
    --
    /forms/(create/update/index/view/delete) - crud forms
    --
    /user-form-results/(index/delete) - crud user result

 user controllers :
    /site/login - login user
    /site/logout - logout user
    /site/index - all form for user 
    /site/answer - user form result
    /site/form - survey user 
    /site/delete-answer - delete survey    
    --


