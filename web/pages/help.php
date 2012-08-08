<?php

	$objTemplate->setText('PAGETITLE', 'Help');
	$objMiniMenu->add('Help Index', 'index.php?action=help');

	if($strSubAction == '')
	{
		print "<ul>";
		print "	<li><a href='index.php?action=help&subaction=faq'>Frequently Asked Questions</a></li>";
		print "	<li><a href='index.php?action=help&subaction=levels'>ZombieCon</a></li>";
		print "	<li><a href='index.php?action=help&subaction=about'>About</a></li>";
		print "</ul>";
	}
	

	if($strSubAction == 'faq')
	{
		print <<<EOT

<table width='100%'>

<tr>
	<td class='qandaheader'>Identifying Zombies</td>
</tr>
<tr>
	<td class='qandaquestion'>
How can I tell if my husband is a zombie? He sits on the couch
all day and "acts" drunk. Whenever I ask him to help in the kitchen, he
just groans. Is he a zombie?	
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Sue-Ellen, Kentucky
	</td>
</tr>
<tr>
	<td class='qandaanswer'>
It is sometimes difficult to determine whether or not someone is
a zombie. Ultimately, unless you have observed someone being bitten and
turning into a zombie, you just can't be sure. That being said, if the
potential zombie shows no signs of wanting to eat your flesh, then it is
likely he is not undead. However, in some cases, it is better to be safe
than sorry and end up as a four-course zombie special. In such cases,
destroy their brain now, and ask questions later.
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Can Zombies Swim</td>
</tr>
<tr>
	<td class='qandaquestion'>
Can zombies swim? I was thinking that we could always set up a
water world that zombies can't get to. (This would be way better than
the one Kevin Costner did.) Or we can move to an isolated island, like
Rhode Island?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Billy, Texas
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

One common misconception is that people are safe on a ship,
boat, or island during a zombie outbreak. Many people that believe this
have only realized that they weren't safe when they woke up in the
rotting arms of the undead. Zombies don't need air or food. What's more,
zombies typically don't float, as their flesh doesn't rot fast enough to
keep them afloat as with standard corpses. As such, undead could be
walking on a lake or ocean floor for an extended period of time. These
zombies represent a substantial danger as they have often surfaced in
areas after an outbreak was thought to be contained. Furthermore, there
have been reports that zombies have climbed the anchors of unsuspecting
boaters. Always be vigilant during an outbreak, as even when you think
you're safe; otherwise, you may be the target of the animated dead!
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>How to Kill Zombies</td>
</tr>
<tr>
	<td class='qandaquestion'>
How do I kill a zombie? I saw on TV that you need to shoot them
in the head because that's what makes them tick. What kind of gun do you
need? My dad will only let me shoot his shotgun because he says that
they are safer than handguns.
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Kyle, North Carolina
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

Once the brain of a zombie is destroyed, it will no longer
animate. The zombie plague virus mutates the brain, which kills the
host, then takes control of the body. As such, by destroying the brain,
this connection is severed and the walking dead simply become the dead
dead. Any kind of weapon will do the trick; however, we recommend rifles
for long range and weapons similar to the trench spike for short range.
It has been shown that people lose their nerve at short range, making
shot guns and pistols almost useless as tools to destroy the walking
dead.
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>What Causes Zombies</td>
</tr>
<tr>
	<td class='qandaquestion'>
What causes zombies? I mean, can I turn into a zombie if I touch
one? Or if I share a drink with one?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Jon, Ontario
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

The zombie virus is transmitted through blood and fluids that
carry it. As such, if one touches you, you are not likely to become a
member of the walking dead. However, you must be careful, as any fluids
from the zombie could carry and pass on the disease. Many zombie
fighters have become one of the ranks of the walking dead by failing to
take the proper care when dealing with recently destroyed undead. It is
worth noting however, that since zombies are dead, their fluids do not
flow as readily as their living counterparts and so infection is not as
likely as it would be with a living person. As to your question about
sharing a drink with a zombie, it is not advisable. The close proximity
required to actually share a drink would make the drink itself the least
of your worries.
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Zombie Sex</td>
</tr>
<tr>
	<td class='qandaquestion'>
Do zombies have sex?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Pieter, Alberta
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

Since the previous lives of zombies are all but destroyed, and
since sexual reproduction is not a factor of zombie-kind, they do not
attempt to enter into sexual relations of any kind. There have been
reports of sexual relations with the undead, often by people who failed
to notice the state of their partners before partaking in such activity.
However, in all reported cases it is unknown whether the sexual
relations were sufficient to transmit the disease. This is because the
individuals who have partaken are typically infected by the bites they
have also received. There was a single report of a person that had had
sexual relations with an infected, but not yet dead person during an
outbreak in 1982. The person did indeed contract the disease and died
and reanimated shortly afterward.
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Zombie Fetuses</td>
</tr>
<tr>
	<td class='qandaquestion'>
What happens to the fetus if a mother gets bitten by a zombie?
Is it like Blade? Does the baby turn into a half zombie/half human?
Maybe that's the key to fighting the zombie!
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Ali, California
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

There have been reports of an expectant mother being bitten and
transferring her infection to her unborn child. In a gruesome class two
outbreak in 2004 in the suburban USA a mother died and reanimated.
Investigators noted that she was not the only reanimated corpse: her
unborn child had also reanimated. Care is to be taken when dealing with
zombies in this case, as an infected baby can be as dangerous as an
infected mother, albeit without teeth.
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Eating Each Other</td>
</tr>
<tr>
	<td class='qandaquestion'>
	Why don't zombies eat each other? Do they have some pheromones
that only they can sense? Someone should extract that and bottle it. I
would pay for that kind of protection!
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Sam, Nevada
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

Zombies crave warm flesh, something that other zombies just
can't provide. Furthermore, from observations it has been noted that
zombies are sensitive to fast, precise movement. This is likely how they
identify the living. There have been reports that careful survivors have
been able to go unnoticed in zombie-infested territory by simply moving
quietly, hiding, and not moving like a living human. Although there have
been rumours of zombie sixth senses and pheromones, it is more likely
that zombies within close proximity of humans can simply sense their
heat. In any case, stay out of undead-infested areas whenever possible
and you won't have to worry!
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Zombie Parents</td>
</tr>
<tr>
	<td class='qandaquestion'>
If my mom turns into a zombie, is it okay to kill her? I mean,
she's my mom. And she gave birth to me. Will I go to hell?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Madison, West Virginia
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

Unfortunately, if your mother turns into a zombie, she is
already dead. It would be your job, for the sake of the rest of
humanity, to destroy her walking corpse! Be careful, though, don't risk
being bitten and be prepared to run if necessary. Will you go to hell? I
can't really say. I can assure you, however, that if you don't destroy
her walking corpse, hell will soon come to you!
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Zombie Timeline</td>
</tr>
<tr>
	<td class='qandaquestion'>
How long does it take to turn into a zombie if you've been
infected? My boyfriend has a big bruise on his neck that he says is from
a zombie. I just want to make sure that I'll have enough time to pack up
my stuff when he turns into a zombie. Should I kill him now or wait
until he changes?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Amy, Wyoming
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

Although the infection rate is 100% once bitten, the time it
takes for an infected host to die and reanimate varies greatly. In a
breakout in 1978, it was reported that after a bite, a victim took
nearly a week to succumb to the disease. After dying, reanimation took
only minutes. In another outbreak in 2004, reports of victims being
infected, dying, and reanimating in less than one day were common. Your
best bet is to lock him in the bathroom, get packed, and get out of
there while you still can!
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Zombie Wife</td>
</tr>
<tr>
	<td class='qandaquestion'>
If my wife turns into a zombie, is it okay for me to sleep with
her best friend? She's technically "dead" so it's not like I'm cheating,
right?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Daryl, New York
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

Technically she is dead, yes. However, I would advise you that
if your wife has joined the walking dead, you have more important things
to worry about and deal with than sleeping with your wife's best friend.
Remember, it always seems to be the case that people with low moral
standards die first in zombie outbreaks.
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Zombie Pets</td>
</tr>
<tr>
	<td class='qandaquestion'>
Will my dog turn into a zombie? I've had Puddles since I was 10
and he's part of the family. It would totally suck if he turned into a
zombie.
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Taylor, New York
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

Although the walking dead will attack and devour animals, there
have been no recorded cases of an animal reanimating. The zombie virus
acts too quickly on animals, dissolving the brain entirely and
destroying the ability for reanimation. Puddles won't rise and join the
walking dead, but he will be a target! Keep him quiet and out of sight
whenever possible!
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Zombie Threats</td>
</tr>
<tr>
	<td class='qandaquestion'>
My mom says that if I don't eat all my vegetables, zombies will
come through my bedroom window and eat me. Is that true? Will they also
eat me if I don't do my homework?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Emma, Nova Scotia
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

It appears your mother's motives behind telling you zombie tales
are not aimed at keeping you alive in an outbreak. She is endangering
you more than you know! Many kids like you have become a zombie's lunch
by thinking that they would be safe just because they had eaten all of
their vegetables or had done whatever else their mother had threatened
them with. Zombies don't concern themselves with whether or not you have
finished your homework, only that you are among the living! Remember, if
you see a zombie, get to safety, and then tell someone!
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Training Zombies</td>
</tr>
<tr>
	<td class='qandaquestion'>
I heard that if you capture a zombie, you can train it to do
your bidding. What's up with that?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
B-Rad, Malibu
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

In an outbreak that occurred in 1985, it was reported that a
single zombie was indeed trained to use tools and behave somewhat
similarly to the living. This should be taken with extreme caution,
though. The zombie virus destroys much of the brain, and although it
does utilize parts of the brain to reanimate the body, it cannot learn
and little is left of prior memory. Be safe; destroy the walking dead
before they destroy you! 
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Safe Virgins</td>
</tr>
<tr>
	<td class='qandaquestion'>
Is it true that zombies won't attack you if you're a virgin? My
boyfriend is telling me that it's stupid and that we should have sex in
case zombies attack us. We don't want to die virgins. What do you think?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Melissa, Mississippi
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

Zombies are only interested in one thing: warm, edible flesh.
Virginity or not, a zombie will devour you if he has the chance. In
preparing for a plague of undead, sex should be low on the list of must
dos. I advise you and your boyfriend to get weapons and provisions and
to make escape plans in case a zombie outbreak occurs!
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Zombie Experts</td>
</tr>
<tr>
	<td class='qandaquestion'>
What makes you such an expert in zombie? Have you ever survived
a zombie attack? Have you even seen a real zombie before?
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Jen, Ontario
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

Certain organizations are bent on covering up the truth, and
anyone exposing the truth is in danger of falling victim to not only
undead, but these insane organizations. As such, ZombieMeter members and
correspondents must have their identities protected. However, you can
rest assured that the experience of ZombieMeter members is second to
none.
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>

	<td class='qandaheader'>Vaccine</td>
</tr>
<tr>
	<td class='qandaquestion'>
Isn't there a vaccine that we can use to cure all the zombies?
It took me a long time to find a real girlfriend and I don't want to
lose her to zombies.
	</td>
</tr>
<tr>
	<td class='qandasignature'>
Mark, Manitoba
	</td>
</tr>
<tr>
	<td class='qandaanswer'>

At this time there are no known vaccines or cures for the zombie
plague. Not a single person has survived after becoming infected. The
best way to protect your friends and loved ones is preparations. Be
prepared, have weapons, provisions and a few different contingency plans
and you may well survive if a zombie outbreak occurs near you!
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
</table>

EOT;

	}

	if($strSubAction == 'levels')
	{
print <<<EOT
		The ZombieCon, loosely based on Defcon, has 5 levels:<p>

		<ul>
			<li>Level 1: Normal - minimal zombie activity. None confirmed, if there are any speculations they are very vague.</li>
			<li>Level 2: Likely zombie activity, but if there is an outbreak, it is minor. Furthermore, only specific areas are affected.</li>
			<li>Level 3: Likely more than one class 1 outbreak, or a single class 2 outbreak. Everyone should be on alert in this case, as a class two outbreak could travel thanks to modern transport.</li>
			<li>Level 4: Multiple class 2 outbreaks or a class 3 outbreak. The world should be on alert in this case.</li>
			<li>Level 5: A class 4 outbreak. Basically, you are living in an undead world.</li>
		</ul>

EOT;
	}

	if($strSubAction == 'about')
	{
		print <<<EOT

			<table>
				<tr>
					<td class='aboutheader'>Our Mission....</td>
				</tr>
				<tr>
					<td class='aboutbody'>
<p>The mission of ZombieMeter is to serve our readers by providing valuable information on zombie outbreaks in every corner of the world.  We dig deeper for facts to break stories thanks to the experience of our members and correspondents. We are dedicated to present all sides of the story accurately, especially the ones that certain organizations don.t want us to reveal.  We pride ourselves in having readers that can make informed decisions based on ALL the facts and we will take the risk to expose the truth. As such, ZombieMeter members and correspondents must conceal their true identities. This not only protects us, but our readers.</p>
					</td>
				</tr>
			</table>
<br><br>
			<table>
				<tr>
					<td class='aboutheader'>About Us</td>
				</tr>
				<tr>
					<td class='aboutbody'>
<h3>Rodge</h3>
<p>Rodge was a former Yale professor of parapsychology whose life took a turn for the worse when his brother was killed by zombies in 2002. Since then, he had dedicated his life towards fighting this evil and teaching others. He has worked with such notable scientist as Dr. Egon Spengler, and is the creator of the "R-Method", a method of extracting telekinetic energy from animals. His aspiration is to create the Zombie Hunter Academy for youths aged 7 to 17. He is hoping to receive an honorary doctorate from the University of Winnipeg.</p>

<h3>Peter</h3>
<p>Peter has been a zombie expert spanning three decades and has dedicated his life to protecting the innocent from zombies. His passion began as a young boy of five and has cumulated to six books and numerous TV appearances. (Rumor has it that he dated a certain Ms. Walters after she interviewed him.) His latest book, "The Zombie in You" will be released next year and come with a dvd. "My rigid dedication to the fight against the zombie plague has seen me as an outcast from mainstream society. But it is a sacrifice I am willing to make for the survival of humanity!"</p>

<h3>Emma</h3>
<p>Emma is the newest addition to the ZombieMeter family as the Asian correspondent. With over 10 years in the elite terrorist hunting cell of the Chinese military, she has honed and transformed her skills of terrorist detection to zombies, often uncovering Government cover-ups. Her covert journalism has earned her five Emmy nominations (with two wins) and countless reporting awards including a Lifetime Achievement Award from International Women's Media Foundation. In her spare time, she volunteers at a women's shelter and bakes cookies for the local community center.</p>

					</td>
				</tr>
			</table>
				

EOT;
	}
?>
