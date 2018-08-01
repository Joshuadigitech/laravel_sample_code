<template>
    <ul class="chat" >
        <div v-for="message in messages" >
            <div v-if="message.room_id == room_id">
                <div class="right clearfix" style="paddingTop:12px" >
                    <div class="" v-if="message.user.id == texter">
                        <div class="header">
                            <!-- <img src="http://localhost/client_portal/resources/assets/js/components/avatar.png"  width="15" height="15"> -->
                            <!-- <strong class="pull-right primary-font">
                                
                                {{ message.user.first_name }}
                                
       
                            </strong> -->

                           
                        </div>
                        <div class="pull-right">
                            <small>
                                <i class="icon-time"></i>
                                <!-- @php echo " ".timeInterval(message.created_at); 
                                @endphp -->
                                {{formatAMPM(message.created_at)}}
                            </small>
                            <div class="paragraph_right">
                            <p style="font-size: 1.3em; paddingTop:5px">
                            {{ message.message }}                            
                        </p>
                        </div>

                        <img src="http://clientportal.oboxdigitech.com/resources/assets/js/components/avatar.png"  width="20" height="20">
                        </div>
                    </div>
                    <div class="" v-if="message.user.id != texter">
                        <div class="header">
                            <!-- <strong class="pull-left primary-font"> -->
                                <!-- <img src="http://localhost/client_portal/resources/assets/js/components/avatar.png"  width="15" height="15"> -->
                               <!--  {{ message.user.first_name }}
                            </strong> -->
                            
                        </div>
                        <div class="pull-left">
                            <img src="http://clientportal.oboxdigitech.com/resources/assets/js/components/avatar.png"  width="20" height="20"
                            >
                        <div class="paragraph_left">
                        <p style="font-size: 1.3em;paddingTop:5px; color:white">
                            
                            {{ message.message }}
                        </p>
                        </div>
                        <small>
                                <i class="icon-time"></i>
                                <!-- @php echo " ".timeInterval(message.created_at); 
                                @endphp -->
                                {{formatAMPM(message.created_at)}}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </ul>
</template>

<script>
export default {
  props: ['messages','room_id','texter'],
  methods:{
        formatAMPM:function(date) {
        var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        var b=new Date(date+" UTC");
        //alert(months[b.getMonth()]);
        var hours = b.getHours();
        var minutes = b.getMinutes();
        var prev_date=' ('+months[b.getMonth()]+' '+b.getDate()+','+b.getUTCFullYear()+')';
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        if(strTime=='12:NaN am'){
            var cd= new Date();
            var hours = cd.getHours();
            var minutes = cd.getMinutes();
            var current_date=' ('+months[cd.getMonth()]+' '+cd.getDate()+','+cd.getUTCFullYear()+')';
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime+current_date;
        }
        else{
            return strTime+prev_date;
        }

    },
    timeAgo:function(dateString) {
        var now= new Date();
        var rightNow = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(),  now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());
        //var rightNow = rightNow1.getUTCDate();
        //alert(rightNow);
        var then = new Date(dateString);

        // if ($.browser.msie) {
        //     // IE can't parse these crazy Ruby dates
        //     then = Date.parse(dateString.replace(/( \+)/, ' UTC$1'));
        // }

        var diff = rightNow - then;

        var second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24,
        week = day * 7;

        if (isNaN(diff) || diff < 0) {
            return ""; // return blank string if unknown
        }

        if (diff < second * 2) {
            // within 2 seconds
            return "right now";
        }

        if (diff < minute) {
            return Math.floor(diff / second) + " seconds ago";
        }

        if (diff < minute * 2) {
            return "about 1 minute ago";
        }

        if (diff < hour) {
            return Math.floor(diff / minute) + " minutes ago";
        }

        if (diff < hour * 2) {
            return "about 1 hour ago";
        }

        if (diff < day) {             return  Math.floor(diff / hour) + " hours ago";         }           if (diff > day && diff < day * 2) {
            return "yesterday";
        }

        if (diff < day * 365) {
            return Math.floor(diff / day) + " days ago";
        }

        else {
            return "over a year ago";
        }
    }
  }
};
</script>
<style scoped>
    .panel-block {
        flex-direction: column;
        border: none;
    }
    .chat1 {
        color: red;
        height: 200px
    }
    .chat .chat-right, .chat .chat-left {
        max-width: 70%;
        box-shadow: 0 0 8px 0px grey;
        padding: 8px;
        margin: 4px;
    }
    .paragraph_right{
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        max-width: 205px;
        line-height: 130%;
        background: #d9edf7;
    }
    .paragraph_left{
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        max-width: 205px;
        line-height: 130%;
        background: #435f7a;
    }
    .chat-right {
        float: right;
    }
    .chat-left {
        float: left;
    }
    .no-message {
        height: 200px;
        display: flex;
        align-items: center;
    }
</style>