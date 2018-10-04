# iniadconnect
    INIAD People Connect Project

## About IniadConnect (イニトモ)
1. Phase 1: Question Connect Human (問題ー人間)
    1. Main Function
        1. Subject
            * This is where students can come and ask their questions about any subject they don't understand. And then other students or teacher will help them to answer.
            * HR when come to our school can take a look here and find candidates their want easier!
            * Right to access: Anyone can ask and answer any question.
        2. Project
            * This is where students can come and start their project. They can use it promote their project or recruit new member who has save intertest. 
            * Right to access: Anyone can creat they own project. Inside project page, creator can setting whether others can or cannot make a post.
    2. Point System
        * Anyone finds a comment or post is useful, interesting or even funny can give an UPVOTE. One's point is total of all upvote he/she taken from his/her post and comment
        * What can point do: Show everyone that you are intersting person, or you are smart, or you are beautiful, or show how power admin is! <Basicly I'm god in my own world>
    3. Gold System
        * Under thinking
2. Phase 2: Unknown
3. Phase 3: Unknown 

## databaseDesign
* Phase One : Questions connect human
    * Users Table
        * ID
        * Name
        * Email
        * Password
        * Image
        * CardImage
        * Type (_1: student, 2:teacher, 3:admin_)
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
        * SubjectID
        * Upvote (_Welcome to redINIAD_)
        * Gold (_Welcome to redINIAD, under thinking_)
        * Title
        * Content
        * Image 
        * MoreImage (_I know this is stupid, trying to fix_)
        * Timestamps
    
    * Comments Table
        * ID
        * UserID
        * PostID
        * Point
        * Gold
        * Content
        * Timestamps

    * UpVote Table
        * ID
        * UserID
        * TargetID
        * TargetType (_1: post, 2:comment_)
        * VoteType (_1: Up Vote, 10: Gold_)
        * Timestamps