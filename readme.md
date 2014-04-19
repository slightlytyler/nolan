
## CPTs

- Faculty & Ministry

Custom metaboxes setup with Advanced Custom Fields. Save files in `/nhcs/acf`

Clicking the add page button from these posts edit pages requires the user to select the correct template when creating a page (then save it).


## Templates

- Google Spreadsheet (Table Template)

**How To:** Create a single spreadsheet in a Google Doc. Pubish the document to the web. Move your tables 1 column over and 1 row down. Headers are read from row 2. Data in colum A and row 1 are not displayed. Copy the spreadsheet_id from the url into page.

[Example](https://docs.google.com/spreadsheets/d/1_VHSGDt19QbriEOR55C1WwT1fIm1YPBHuekzsV1kJVs/edit?pli=1#gid=0)

    @todo optional second title and description
    @todo cache response in a transient
    @idea sub-templates for better responsive display?


- Department & Ministry

Ministry is the same as Department, but with just Name, Title and Picture data. (Different ACF settings)

Departments are linked to faculty. You can select Faculty from the department pages, or you can select a deparment for each faculty memeber.

    @idea Faculty Pages are a template away, if we can solve the data gathering issue.


Plugins 

ACF - Advanced Custom Fields
Custom Post Type and Template Meta Box editor

P2P - Posts 2 Posts
Define Relationships, Drag & Drop Ordering

https://github.com/scribu/wp-posts-to-posts/wiki/Shortcodes
