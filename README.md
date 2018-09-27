# iniadconnect
    INIAD People Connect Project

## databaseDesign
* Phase One : Questions connect human
    * Users Table
        * ID
        * Name
        * Email
        * Password
        * Image
        * CardImage
        * Type (_1: student, 2:teacher, 3:me_)
        * Language
        * Point (_Thinking_)
        * Token
        * Timestamps

    * Subjects Table
        * ID
        * Code (_school subject code_)
        * UserID
        * Open (_0: Close <==> 1: Open_)
        * Type (_0: School subject, 1: Project, 2: Personal Page_)
        * Name
        * Quote
        * Image
        * CoverImage
        * Timestamps

    * Posts Table
        * ID
        * UserID
        * MasterPostID
        * UpperPostID (_zero if is master post_)
        * Upvote (_Welcome to redINIAD_)
        * Gold (_Welcome to redINIAD, under thinking_)
        * Level (_lazy, not use yet_)
        * Title
        * Content
        * Image
        * MoreImage (_I know this is stupid, trying to fix_)
        * Timestamps

