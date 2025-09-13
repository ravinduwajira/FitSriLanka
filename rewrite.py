import random, datetime

new_name = "ravinduwajira"
new_email = "ravinduwajira@gmail.com"

def random_date():
    now = datetime.datetime.now()
    days_ago = random.randint(0, 730)  # up to 2 years
    new_date = now - datetime.timedelta(days=days_ago,
                                        hours=random.randint(0,23),
                                        minutes=random.randint(0,59))
    return new_date.strftime("%Y-%m-%dT%H:%M:%S")

commit.author_name = new_name
commit.author_email = new_email
commit.committer_name = new_name
commit.committer_email = new_email
commit.author_date = random_date()
commit.committer_date = commit.author_date
