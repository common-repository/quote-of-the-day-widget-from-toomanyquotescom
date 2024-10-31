<?php
/*
Plugin Name: Quote of the Day from TooManyQuotes.com
Plugin URI: http://www.toomanyquotes.com/quote_of_the_day/generator
Description: Places a Quote of the Day on your Wordpress blog. Easily choose from over 300 popular quote topics and authors, or create your own custom list. Uses Asynchronous JavaScript so it will NEVER affect your site's loading or rendering times.
Version: 2.0.2
Author: P.J. Swesey
Author URI: http://www.toomanyquotes.com
*/

function wp_widget_qotd($args) {
	extract($args);
	$options = get_option('widget_qotd');
	$title = $options['title'];
  $type = $options['type'];
	$the_code = $options['the_code'];
	$before_code = $options['before_code'];
	$after_code = $options['after_code'];
	
	if ( empty($type) )
		$type = 'special/1';
	
	$typeId = str_replace('/', '-', $type);

  // If code field is blank, create JavaScript from selected type
  if (trim($the_code) == ''){
    $the_code = "<a href=\"http://www.toomanyquotes.com\" title=\"Quotes and sayings\" target=\"_blank\" id=\"tmq-". $typeId ."\">Quotes and sayings</a>
    <script>
      (function(){
        var s = document.createElement('script');
        s.setAttribute('type', 'text/javascript');
        s.setAttribute('async', 'true');
        s.setAttribute('src', 'http://www.toomanyquotes.com/quote_of_the_day/". $type .".js?v=2');
        var l = document.getElementById('tmq-". $typeId ."');
        l.parentNode.insertBefore(s,l);
      })();
    </script>";
  }
?>
		<?php echo $before_widget; ?>
			<?php $title ? print($before_title . $title . $after_title) : null; ?>
			<?php echo $before_code; ?>
			<?php echo $the_code; ?>
			<?php echo $after_code; ?>
		<?php echo $after_widget; ?>
<?php
}

function wp_widget_qotd_control() {
	$options = $newoptions = get_option('widget_qotd');
	if ( $_POST["qotd-submit"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["qotd-title"]));
		$newoptions['type'] = stripslashes($_POST["qotd-type"]);
		$newoptions['the_code'] = stripslashes($_POST["qotd-code"]);
		$newoptions['before_code'] = stripslashes($_POST["qotd-before-code"]);
		$newoptions['after_code'] = stripslashes($_POST["qotd-after-code"]);
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_qotd', $options);
	}
	$title = attribute_escape($options['title']);
	$type = attribute_escape($options['type']);
	$the_code = attribute_escape($options['the_code']);
	$before_code = attribute_escape($options['before_code']);
	$after_code = attribute_escape($options['after_code']);
	
	$type_arr = array(  "special/1"    => "Specially-Approved Quotes",

	                    "category/238" => "Acting Quotes",
                      "category/219" => "Action Quotes",
                      "category/239" => "Advertising Quotes",
                      "category/66"  => "Advice Quotes",
                      "category/17"  => "Age Quotes",
                      "category/240" => "America Quotes",
                      "category/123" => "Anger Quotes",
                      "category/19"  => "Animals Quotes",
                      "category/89"  => "Apology Quotes",
                      "category/20"  => "Art Quotes",
                      "category/124" => "Atheism Quotes",
                      "category/125" => "Attitude Quotes",
                      "category/70"  => "Auto Quotes",
                      "category/83"  => "Awkward Quotes",
                      "category/102" => "Babies Quotes",
                      "category/241" => "Baseball Quotes",
                      "category/242" => "Basketball Quotes",
                      "category/120" => "Bathroom Quotes",
                      "category/94"  => "Beauty Quotes",
                      "category/105" => "Bible Quotes",
                      "category/126" => "Birth Quotes",
                      "category/22"  => "Birthday Quotes",
                      "category/243" => "Books Quotes",
                      "category/244" => "Boxing Quotes",
                      "category/24"  => "Breakup Quotes",
                      "category/245" => "Business Quotes",
                      "category/272" => "Captivity Quotes",
                      "category/92"  => "Challenge Quotes",
                      "category/127" => "Change Quotes",
                      "category/220" => "Character Quotes",
                      "category/129" => "Children Quotes",
                      "category/284" => "Christmas Quotes",
                      "category/246" => "Church Quotes",
                      "category/221" => "Clever Quotes",
                      "category/247" => "Clothing Quotes",
                      "category/25"  => "Commitment Quotes",
                      "category/130" => "Common Sense Quotes",
                      "category/222" => "Communication Quotes",
                      "category/69"  => "Compliment Quotes",
                      "category/131" => "Compromise Quotes",
                      "category/132" => "Computers Quotes",
                      "category/26"  => "Confidence Quotes",
                      "category/248" => "Cooking Quotes",
                      "category/108" => "Cool Quotes",
                      "category/23"  => "Courage Quotes",
                      "category/282" => "Creepy Quotes",
                      "category/99"  => "Crying Quotes",
                      "category/87"  => "Cute Quotes",
                      "category/116" => "Dancing Quotes",
                      "category/98"  => "Dating Quotes",
                      "category/18"  => "Death Quotes",
                      "category/249" => "Debt Quotes",
                      "category/115" => "Deep Quotes",
                      "category/90"  => "Depression Quotes",
                      "category/250" => "Diets Quotes",
                      "category/91"  => "Disappointment Quotes",
                      "category/223" => "Diversity Quotes",
                      "category/27"  => "Dreams Quotes",
                      "category/16"  => "Drinking Quotes",
                      "category/82"  => "Drugs Quotes",
                      "category/158" => "Economy Quotes",
                      "category/79"  => "Education Quotes",
                      "category/279" => "Encouragement Quotes",
                      "category/273" => "Environment Quotes",
                      "category/224" => "Equality Quotes",
                      "category/15"  => "Exclamations Quotes",
                      "category/274" => "Excuses Quotes",
                      "category/225" => "Failure Quotes",
                      "category/226" => "Fairness Quotes",
                      "category/28"  => "Faith Quotes",
                      "category/29"  => "Family Quotes",
                      "category/12"  => "Famous Quotes",
                      "category/95"  => "Fat Quotes",
                      "category/112" => "Fear Quotes",
                      "category/227" => "Feminine Quotes",
                      "category/84"  => "Fighting Quotes",
                      "category/251" => "Fishing Quotes",
                      "category/252" => "Fitness Quotes",
                      "category/159" => "Flowers Quotes",
                      "category/30"  => "Food Quotes",
                      "category/253" => "Football Quotes",
                      "category/160" => "Forgiveness Quotes",
                      "category/103" => "Free Quotes",
                      "category/31"  => "Freedom Quotes",
                      "category/32"  => "Friendship Quotes",
                      "category/9>"  => "Funny Quotes",
                      "category/135" => "Future Quotes",
                      "category/136" => "Garden Quotes",
                      "category/137" => "Giving Quotes",
                      "category/228" => "Goals Quotes",
                      "category/33"  => "God Quotes",
                      "category/254" => "Golf Quotes",
                      "category/269" => "Goodbyes Quotes",
                      "category/34"  => "Government Quotes",
                      "category/35"  => "Graduation Quotes",
                      "category/229" => "Greatness Quotes",
                      "category/140" => "Greed Quotes",
                      "category/72"  => "Greetings Quotes",
                      "category/141" => "Grief Quotes",
                      "category/85"  => "Gross Quotes",
                      "category/128" => "Growth Quotes",
                      "category/74"  => "Guns Quotes",
                      "category/119" => "Happiness Quotes",
                      "category/109" => "Hate Quotes",
                      "category/36"  => "Health Quotes",
                      "category/106" => "Heart Quotes",
                      "category/157" => "Heroes Quotes",
                      "category/37"  => "History Quotes",
                      "category/77"  => "Holidays Quotes",
                      "category/81"  => "Homosexual Quotes",
                      "category/96"  => "Honor Quotes",
                      "category/97"  => "Hope Quotes",
                      "category/275" => "Humanity Quotes",
                      "category/280" => "Hunting Quotes",
                      "category/5>"  => "Inspirational Quotes",
                      "category/3>"  => "Insult Quotes",
                      "category/255" => "Insurance Quotes",
                      "category/161" => "Jokes Quotes",
                      "category/278" => "Joy Quotes",
                      "category/230" => "Knowledge Quotes",
                      "category/276" => "Language Quotes",
                      "category/38"  => "Last Words Quotes",
                      "category/39"  => "Laughter Quotes",
                      "category/256" => "Law Quotes",
                      "category/111" => "Leadership Quotes",
                      "category/104" => "Life Quotes",
                      "category/40"  => "Love Quotes",
                      "category/41"  => "Loyalty Quotes",
                      "category/231" => "Luck Quotes",
                      "category/257" => "Magic Quotes",
                      "category/285" => "Marketing Quotes",
                      "category/232" => "Masculinity Quotes",
                      "category/156" => "Math Quotes",
                      "category/164" => "Memories Quotes",
                      "category/13"  => "Metaphor Quotes",
                      "category/258" => "Military Quotes",
                      "category/142" => "Minorities Quotes",
                      "category/143" => "Mistakes Quotes",
                      "category/42"  => "Money Quotes",
                      "category/233" => "Morals Quotes",
                      "category/11"  => "Motivational Quotes",
                      "category/68"  => "Music Quotes",
                      "category/139" => "Name-Calling Quotes",
                      "category/259" => "Nature Quotes",
                      "category/144" => "News Quotes",
                      "category/117" => "Nice Quotes",
                      "category/270" => "Observations Quotes",
                      "category/43"  => "Opportunity Quotes",
                      "category/234" => "Pain Quotes",
                      "category/260" => "Parents Quotes",
                      "category/145" => "Patience Quotes",
                      "category/100" => "Patriotic Quotes",
                      "category/44"  => "Peace Quotes",
                      "category/146" => "Perfection Quotes",
                      "category/147" => "Philosophy Quotes",
                      "category/88"  => "Pickup Lines Quotes",
                      "category/45"  => "Pleasure Quotes",
                      "category/107" => "Poetry Quotes",
                      "category/7>"  => "Political Quotes",
                      "category/46"  => "Poverty Quotes",
                      "category/47"  => "Prayer Quotes",
                      "category/149" => "Prejudice Quotes",
                      "category/118" => "Presidential Quotes",
                      "category/48"  => "Pride Quotes",
                      "category/49"  => "Procrastination Quotes",
                      "category/121" => "Promise Quotes",
                      "category/21"  => "Proverbs Quotes",
                      "category/283" => "Psychology Quotes",
                      "category/148" => "Purpose Quotes",
                      "category/1>"  => "Question Quotes",
                      "category/150" => "Racism Quotes",
                      "category/86"  => "Reading Quotes",
                      "category/52"  => "Rebellion Quotes",
                      "category/65"  => "Redneck Quotes",
                      "category/235" => "Religion Quotes",
                      "category/53"  => "Respect Quotes",
                      "category/54"  => "Responsibility Quotes",
                      "category/2>"  => "Retort Quotes",
                      "category/55"  => "Revenge Quotes",
                      "category/56"  => "Sacrifice Quotes",
                      "category/57"  => "Sad Quotes",
                      "category/80"  => "Sarcasm Quotes",
                      "category/101" => "Sayings Quotes",
                      "category/58"  => "Science Quotes",
                      "category/261" => "Seasons Quotes",
                      "category/14"  => "Sentimental Quotes",
                      "category/114" => "Service Quotes",
                      "category/67"  => "Sexual Quotes",
                      "category/138" => "Sharing Quotes",
                      "category/281" => "Shopping Quotes",
                      "category/75"  => "Simile Quotes",
                      "category/163" => "Sleep Quotes",
                      "category/73"  => "Smoking Quotes",
                      "category/262" => "Soccer Quotes",
                      "category/263" => "Society Quotes",
                      "category/151" => "Spirituality Quotes",
                      "category/6>"  => "ports Quotes",
                      "category/236" => "Strength Quotes",
                      "category/162" => "Stupid Quotes",
                      "category/59"  => "Success Quotes",
                      "category/122" => "Sympathy Quotes",
                      "category/264" => "Taxes Quotes",
                      "category/93"  => "Teamwork Quotes",
                      "category/265" => "Technology Quotes",
                      "category/113" => "Thankfulness Quotes",
                      "category/271" => "Threats Quotes",
                      "category/60"  => "Time Quotes",
                      "category/71"  => "Travel Quotes",
                      "category/152" => "Trust Quotes",
                      "category/61"  => "Truth Quotes",
                      "category/78"  => "Vacation Quotes",
                      "category/237" => "Victory Quotes",
                      "category/266" => "Voting Quotes",
                      "category/62"  => "War Quotes",
                      "category/76"  => "Weather Quotes",
                      "category/63"  => "Weddings Quotes",
                      "category/8>"  => "Weird Quotes",
                      "category/153" => "Winning Quotes",
                      "category/10"  => "Wisdom Quotes",
                      "category/267" => "Womens rights Quotes",
                      "category/64"  => "Work Quotes",
                      "category/110" => "World Quotes",
                      "category/154" => "Worry Quotes",
                      "category/268" => "Wrestling Quotes",
                      "category/155" => "Writing Quotes",
                      
                      "person/663"  =>  "Adam Samberg Quotes",
                      "person/181"  =>  "Agatha Christie Quotes",
                      "person/252"  =>  "Albert Einstein Quotes",
                      "person/670"  =>  "Alec Baldwin Quotes",
                      "person/95"   =>  "nna Faris Quotes",
                      "person/684"  =>  "Antoine de Saint-Exupery Quotes",
                      "person/110"  =>  "Art LaFleur Quotes",
                      "person/3"    =>  "Bll Murray Quotes",
                      "person/1107" =>  "Bradley Whitford Quotes",
                      "person/1188" =>  "Charles Dickens Quotes",
                      "person/492"  =>  "Charlie Day Quotes",
                      "person/11"   =>  "Christopher Walken Quotes",
                      "person/853"  =>  "Corbin Bernsen Quotes",
                      "person/454"  =>  "Cote de Pablo Quotes",
                      "person/214"  =>  "Cullen Hightower Quotes",
                      "person/94"   =>  "Dana Goodman Quotes",
                      "person/1426" =>  "Daniel Rose Quotes",
                      "person/79"   =>  "Danny DeVito Quotes",
                      "person/657"  =>  "Danny McBride Quotes",
                      "person/13"   =>  "David Spade Quotes",
                      "person/717"  =>  "Dennis Rodman Quotes",
                      "person/633"  =>  "Don Vito Quotes",
                      "person/576"  =>  "Dorothy Bernard Quotes",
                      "person/703"  =>  "Douglas Noel Adams Quotes",
                      "person/637"  =>  "Edward Norton Quotes",
                      "person/96"   =>  "Emma Stone Quotes",
                      "person/129"  =>  "Fred Tatasciore Quotes",
                      "person/934"  =>  "Gandhi Quotes",
                      "person/732"  =>  "George S. Patton Quotes",
                      "person/493"  =>  "Glenn Howerton Quotes",
                      "person/1076" =>  "H. Jon Benjamin Quotes",
                      "person/256"  =>  "Helen Keller Quotes",
                      "person/149"  =>  "Henry David Thoreau Quotes",
                      "person/277"  =>  "Herman Sanchez Quotes",
                      "person/25"   =>  "an McKellen Quotes",
                      "person/1178" =>  "J.K. Rowling Quotes",
                      "person/1533" =>  "Jack LaLanne Quotes",
                      "person/855"  =>  "James Roday Quotes",
                      "person/126"  =>  "Jen Taylor Quotes",
                      "person/87"   =>  "Jim Carrey Quotes",
                      "person/650"  =>  "Jim Davis Quotes",
                      "person/646"  =>  "Joe Lo Truglio Quotes",
                      "person/114"  =>  "John C. Reilly Quotes",
                      "person/127"  =>  "John Di Maggio Quotes",
                      "person/268"  =>  "John F. Kennedy Quotes",
                      "person/1169" =>  "John Lennon Quotes",
                      "person/863"  =>  "Jud Tylor Quotes",
                      "person/494"  =>  "Kaitlin Olson Quotes",
                      "person/1564" =>  "Kazeronnie Mak Quotes",
                      "person/1106" =>  "Kristin Kreuk Quotes",
                      "person/780"  =>  "Lewis B. Chesty Puller Quotes",
                      "person/1489" =>  "Luke Agius Melbourne Quotes",
                      "person/195"  =>  "Mae West Quotes",
                      "person/859"  =>  "Mark Harmon Quotes",
                      "person/244"  =>  "Mark Twain Quotes",
                      "person/947"  =>  "Mark Z. Danielewski Quotes",
                      "person/822"  =>  "Michael Jackson Quotes",
                      "person/455"  =>  "Michael Weatherly Quotes",
                      "person/705"  =>  "Michel Gondry Quotes",
                      "person/781"  =>  "Mike Myers Quotes",
                      "person/714"  =>  "Mike Tyson Quotes",
                      "person/807"  =>  "Mother Teresa Quotes",
                      "person/67"   =>  "Nick Swardson Quotes",
                      "person/734"  =>  "Paris Hilton Quotes",
                      "person/109"  =>  "Patrick Renna Quotes",
                      "person/60"   =>  "Paul Rudd Quotes",
                      "person/1172" =>  "Rainer Maria Rilke Quotes",
                      "person/75"   =>  "Rainn Wilson Quotes",
                      "person/162"  =>  "Ralph Waldo Emerson Quotes",
                      "person/1170" =>  "Ray Bradbury Quotes",
                      "person/491"  =>  "Rob McElhenney Quotes",
                      "person/54"   =>  "Robin Williams Quotes",
                      "person/702"  =>  "Seth Rogen Quotes",
                      "person/788"  =>  "Stephenie Meyer Quotes",
                      "person/81"   =>  "Steve Carell Quotes",
                      "person/1273" =>  "Steve Jobs Quotes",
                      "person/762"  =>  "Steve Little Quotes",
                      "person/671"  =>  "Steve Smith Quotes",
                      "person/257"  =>  "Thomas Jefferson Quotes",
                      "person/654"  =>  "Tina Fey Quotes",
                      "person/901"  =>  "Tracy Morgan Quotes",
                      "person/1143" =>  "Vanna Bonta Quotes",
                      "person/659"  =>  "Wayne Gretzky Quotes",
                      "person/399"  =>  "Will Arnett Quotes",
                      "person/68"   =>  "Will Ferrell Quotes",
                      "person/163"  =>  "William Shakespeare Quotes",
                      "person/136"  =>  "Wilson Rawls Quotes",
                      "person/258"  =>  "Winston Churchill Quotes"
	            );
?>
	<p>
		<label for="qotd-title"><?php _e('Widget Title'); ?></label>
		<br /><input style="width: 200px;" id="qotd-title" name="qotd-title" type="text" value="<?php echo $title; ?>" />
	</p>
	
  <p>
		<label for="qotd-select"><?php _e('Type of Quotes'); ?></label>
		<br />
		<select id="qotd-type" name="qotd-type">
		<?php foreach ($type_arr as $key => $value){
      echo '<option value="'. $key .'"';
      if ($key == $type){
        echo ' selected="selected"';
      }
      echo '>'. $value .'</option>';
		} ?>
		</select>
	</p>
		
	<p>
		<label for="qotd-code"><?php _e('Or override with a custom script from TooManyQuotes.com'); ?></label>
		<br /><textarea id="qotd-code" name="qotd-code" rows="3" cols="20"><?php echo $the_code; ?></textarea>
	</p>
	
	<p>
		<label for="qotd-before-code"><?php _e('Preceding text'); ?></label>
		<br /><input style="width: 200px;" id="qotd-before-code" name="qotd-before-code" type="text" value="<?php echo $before_code; ?>" />
	</p>
	
	<p>
		<label for="qotd-after-code"><?php _e('Following text'); ?></label>
		<br /><input style="width: 200px;" id="qotd-after-code" name="qotd-after-code" type="text" value="<?php echo $after_code; ?>" />
	</p>
			<input type="hidden" id="qotd-submit" name="qotd-submit" value="1" />
<?php
}

function wp_widget_qotd_register() {
	$dimension = array('height' => 180, 'width' => 200);
	$class = array('classname' => 'widget_qotd');
	wp_register_sidebar_widget('qotd', __('Quote of the Day'), 'wp_widget_qotd', $class);
	wp_register_widget_control('qotd', __('Quote of the Day'), 'wp_widget_qotd_control', $dimension);
}

add_action('plugins_loaded','wp_widget_qotd_register');

?>