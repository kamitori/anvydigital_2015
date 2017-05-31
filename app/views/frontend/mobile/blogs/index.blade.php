<div class="b_title col-md-10 col-md-offset-1 alignfix" id="blog_title">The Blog</div>
<div class="col-xs-12 alignfix display_blog" style="padding:0;">
    <div id="blogsidebar" class="blog-sidebar col-xs-12" style="padding:0">
    </div>
    <div id="anvyblog" class="blog-container col-xs-12">
    </div>
    
</div>
<style type="text/css">
    .blog-post img{
        max-width: 95%;
        max-height: 100%;
    }
    #blogsidebar .widget-content{
        display:none;
    }
</style>
@section('pageJS')
<script src="{{ URL::asset( 'assets/global/plugins/sticky/jquery.sticky.js' ) }}" type="text/javascript"></script>
<script type="text/javascript" src="http://www.google.com/jsapi" style="color: rgb(0, 0, 0);"></script>
<script src="http://www.google.com/uds/?file=feeds&amp;v=1" type="text/javascript"></script>
<script type="text/javascript">
// $("#blogsidebar").sticky({topSpacing:0, wrapperClassName: 'blog-sidebar-wrapper col-xs-4'})
//                 .on('click', '.hierachy .year', function(){
//                     $(this).parent().toggleClass('expanded');
//                 });

google.load("feeds", "1"); //Load Google Ajax Feed API (version 1)
var  ENTRIES = -1 // get all blog entries
    ,DEFAULT_ENTRIES = 25 // incase no blog time is specified, load 25 latest entries
    ,monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]
    ,arrArchives = new Array() // archives is associative array where key is "year" and values an array of month => number of entries of that month
    ,feedpointer = new google.feeds.Feed("http://blog.anvydigital.com/feeds/posts/default")
    ,needFilter
    ,blogMonth = '{{ $blogMonth }}'
    ,blogYear = '{{ $blogYear }}'
    ,rssOutput = ""
    ,archive = ""
    ;

if (blogYear === '' && blogMonth === '') {
    needFilter = false;
} else {
    needFilter = true;

    // update the title ("The Blog") with Year and Month
    document.getElementById("blog_title").innerHTML = "The Blog " + blogYear + " : " + blogMonth;
}

feedpointer.includeHistoricalEntries();
feedpointer.setNumEntries(ENTRIES); //Show all entries to filter by year-month
feedpointer.load(formatoutput);

function formatoutput(result){
    if (!result.error){
        var theFeeds=result.feed.entries;
        for (var i=0; i<theFeeds.length; i++) {
            var  categories = theFeeds[i].categories
                ,content = theFeeds[i].content
                ,publishedDate = theFeeds[i].publishedDate
                ,title = theFeeds[i].title
                ,year
                ,month
                ;

            // temporaryly delete the deleted entry  (test blog)
            if (content.localeCompare('test blog') === 0) {
                continue;
            }

            var entryDate = new Date(publishedDate); //get date of entry
            year = String(entryDate.getFullYear());
            month = monthNames[entryDate.getMonth()];
            addEntryToArchive(year, month);

            // in case no blog time specified, load 25 latest entries
            if (needFilter === false) {
                if (i <= DEFAULT_ENTRIES) {
                    addEntryToBlogList(entryDate, categories, title, content);
                }
            } else {
                if (blogYear.localeCompare(year) === 0 && blogMonth.localeCompare(month) === 0) {
                    addEntryToBlogList(entryDate, categories, title, content);
                }
            }
        }
        generateArchive();
        document.getElementById("anvyblog").innerHTML = rssOutput;
        document.getElementById("blogsidebar").innerHTML = archive;
        $(".title-archive").on("click",function(){
            $("#blogsidebar .widget-content").toggle();
        })
    }
}

function addEntryToBlogList(entryDate, categories, title, content) {
    var readableDate = entryDate.toDateString(); // parses the output into a readable string
    var categoriesStr = '';
    for (var j=0; j<categories.length; j++) {
        var category = categories[j];
        var catLink = "http://blog.anvydigital.com/search/label/" + encodeURI(category);
        categoriesStr += '<a href="' + catLink + '" rel="tag">' + category + '</a> ';
    }
    rssOutput += '<div class="blog-post"><div class="blog-title" id="'+ title +'">' + title + '</div>' + '<p class="blog-date">' + readableDate + '</p>';
    rssOutput += '<p>' + content + '</p>';
    /*rssOutput += '<ul class="share-buttons"><li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.anvydigital.com%2Findex.php%3Fcontent%3Danvyblog&t=The%20Anvy%20Blog" title="Share on Facebook" target="_blank"><img src="images/icons/Facebook.png"></a></li><li><a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fwww.anvydigital.com%2Findex.php%3Fcontent%3Danvyblog&text=The%20Anvy%20Blog:%20http%3A%2F%2Fwww.anvydigital.com%2Findex.php%3Fcontent%3Danvyblog&via=AnvyDigital" target="_blank" title="Tweet"><img src="images/icons/Twitter.png"></a></li><li><a href="https://plus.google.com/share?url=http%3A%2F%2Fwww.anvydigital.com%2Findex.php%3Fcontent%3Danvyblog" target="_blank" title="Share on Google+"><img src="images/icons/Google+.png"></a></li><li><a href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fwww.anvydigital.com%2Findex.php%3Fcontent%3Danvyblog&title=The%20Anvy%20Blog&summary=Anvy%20Digital%20is%20the%20TAC%20expert%20for%20window%2C%20wall%20and%20floor%20graphics.%20We%20are%20a%20large%20format%20digital%20printer%20based%20in%20Calgary%2C%20Alberta.%20The%20Anvy%20Blog%20posts%20articles%20about%20sales%2C%20new%20print%20products%20and%20events.&source=http%3A%2F%2Fwww.anvydigital.com%2Findex.php%3Fcontent%3Danvyblog" target="_blank" title="Share on LinkedIn"><img src="images/icons/LinkedIn.png"></a></li><li><a href="mailto:?subject=The%20Anvy%20Blog&body=Anvy%20Digital%20is%20the%20TAC%20expert%20for%20window%2C%20wall%20and%20floor%20graphics.%20We%20are%20a%20large%20format%20digital%20printer%20based%20in%20Calgary%2C%20Alberta.%20The%20Anvy%20Blog%20posts%20articles%20about%20sales%2C%20new%20print%20products%20and%20events.:%20http%3A%2F%2Fwww.anvydigital.com%2Findex.php%3Fcontent%3Danvyblog" target="_blank" title="Email"><img src="images/icons/Email.png"></a></li></ul>';*/
    rssOutput += '<div class="post-footer-line post-footer-line-2"> <span class="post-label"> Labels: ' + categoriesStr + '</span> </div>';
    rssOutput += '</div>';
}

// add an entry to arrChives -
function addEntryToArchive(year, month) {
    year = String(year);
    month = String(month);

    var arrMonths;
    if (arrArchives[year] === undefined) {
        arrMonths = new Array();
        arrMonths[month] = 1;
        arrArchives[year] = arrMonths;
    } else {
        arrMonths = arrArchives[year];
        if (arrMonths[month] === undefined) {
            arrMonths[month] = 1;
        } else {
            arrMonths[month] = arrMonths[month] + 1;
        }
    }
}

// generate archive
function generateArchive() {
    var  arrMonths
        ,month
        ,arrYears
        ,year
        ,month
        ,blogTime
        ,blogAmount
        ;

    archive = "";
    //archive = archive + '<a href="{{ URL.'/blogs' }}"><h2 style="margin-left: 30px;"> Blog Archive </h2></a>';
    archive = archive + '<h3 style="text-align:center;" class="title-archive"> Blog Archive </h3>';
    archive = archive + '<div class="widget-content">';
    // get years in most recent order
    arrYears = [];
    for (year in arrArchives) {
        if (arrArchives.hasOwnProperty(year)) {
            arrYears.push(parseInt(year));
        }
    }
    arrYears = arrYears.sort(function(a,b) {return b-a;});

    for (var i = 0; i < arrYears.length; i++) {
        year = String(arrYears[i]);
        if (arrArchives.hasOwnProperty(year)) {
            archive = archive + '<ul class="hierachy"> <li class="archivedate expanded">';
            archive = archive + '<h4 class="year">' + year + '</h4>';
            arrMonths = arrArchives[year];
            archive = archive + '<ul class="hierachy">';
            for (month in arrMonths) {
                if (arrMonths.hasOwnProperty(month)) {
                    blogTime = year + "/" + month;
                    blogAmount = arrMonths[month];
                    archive = archive + '<a href="' + '{{ URL }}' + '/blogs/' + blogTime + '">' + '<li>' + month + ' (' + blogAmount +  ') </li></a>';
                }
            }
            archive = archive + '</ul>';
            archive = archive + '</li></ul>';
        }
    }
    archive = archive + '</div>';
}
</script>
@stop