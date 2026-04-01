-- ============================================================
-- quotesdb — INF653 Midterm Schema & Seed Data
-- ============================================================

CREATE TABLE IF NOT EXISTS authors (
    id     SERIAL PRIMARY KEY,
    author VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS categories (
    id       SERIAL PRIMARY KEY,
    category VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS quotes (
    id          SERIAL PRIMARY KEY,
    quote       TEXT        NOT NULL,
    author_id   INTEGER     NOT NULL,
    category_id INTEGER     NOT NULL,
    CONSTRAINT fk_author   FOREIGN KEY (author_id)   REFERENCES authors(id),
    CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- ============================================================
-- Seed Data — satisfies ALL automated test requirements:
--   • author id=5  (Lebowski) exists
--   • category id=4 (Very Chill) exists
--   • quote id=10  exists
--   • author id=5 has 2 quotes in category id=4
--   • Minimum: 5 authors, 5 categories, 25 quotes
-- ============================================================

-- 5+ Authors (id=5 must be Lebowski per test requirements)
INSERT INTO authors (author) VALUES
    ('Neil deGrasse Tyson'),   -- id=1
    ('Albert Einstein'),       -- id=2
    ('Bill Gates'),            -- id=3
    ('John F. Kennedy'),       -- id=4
    ('Lebowski'),              -- id=5  ← REQUIRED by automated tests
    ('Mark Twain'),            -- id=6
    ('Maya Angelou'),          -- id=7
    ('Oscar Wilde'),           -- id=8
    ('Winston Churchill'),     -- id=9
    ('Aristotle');             -- id=10

-- 5+ Categories (id=4 must be Very Chill per test requirements)
INSERT INTO categories (category) VALUES
    ('Knowledge-Learning'),    -- id=1
    ('Code-Data-Design'),      -- id=2
    ('Travel'),                -- id=3
    ('Very Chill'),            -- id=4  ← REQUIRED by automated tests
    ('Motivation'),            -- id=5
    ('Honesty'),               -- id=6
    ('Life'),                  -- id=7
    ('Philosophy'),            -- id=8
    ('Humor');                 -- id=9

-- 25+ Quotes (id=10 must exist; author_id=5 must have 2 quotes in category_id=4)
INSERT INTO quotes (quote, author_id, category_id) VALUES
    ('The greatest enemy of knowledge is not ignorance, it is the illusion of knowledge.', 1, 1),           -- id=1
    ('Imagination is more important than knowledge.', 2, 1),                                                 -- id=2
    ('The greater our knowledge increases the more our ignorance unfolds.', 4, 1),                           -- id=3
    ('Real knowledge is to know the extent of one''s ignorance.', 5, 1),                                    -- id=4
    ('Never memorize what you can look up in books.', 2, 1),                                                 -- id=5
    ('Learning to write programs stretches your mind and helps you think better.', 3, 2),                    -- id=6
    ('The only limit to our realization of tomorrow is our doubts of today.', 4, 5),                         -- id=7
    ('The will to win unlocks the door to personal excellence.', 5, 4),                                      -- id=8  Lebowski + Very Chill (1 of 2)
    ('The world is a book, and those who do not travel read only a page.', 7, 3),                            -- id=9
    ('That rug really tied the room together.', 5, 4),                                                       -- id=10 Lebowski + Very Chill (2 of 2) ← REQUIRED
    ('Truth is stranger than fiction, but it is because Fiction is obliged to stick to possibilities.', 6, 6), -- id=11
    ('Travel is fatal to prejudice, bigotry, and narrow-mindedness.', 6, 3),                                 -- id=12
    ('Be yourself; everyone else is already taken.', 8, 7),                                                  -- id=13
    ('The only way to get rid of a temptation is to yield to it.', 8, 9),                                    -- id=14
    ('We shall never surrender.', 9, 5),                                                                      -- id=15
    ('Success is not final, failure is not fatal — it is the courage to continue that counts.', 9, 5),       -- id=16
    ('Knowing yourself is the beginning of all wisdom.', 10, 8),                                             -- id=17
    ('Happiness depends upon ourselves.', 10, 7),                                                             -- id=18
    ('In the middle of every difficulty lies opportunity.', 2, 5),                                            -- id=19
    ('If you can dream it, you can do it.', 3, 5),                                                            -- id=20
    ('Life is what happens when you''re busy making other plans.', 1, 7),                                    -- id=21
    ('You will face many defeats in life, but never let yourself be defeated.', 7, 5),                       -- id=22
    ('Do or do not, there is no try.', 1, 5),                                                                 -- id=23
    ('I don''t pretend we have all the answers. But the questions are certainly worth thinking about.', 1, 8), -- id=24
    ('Design is not just what it looks like. Design is how it works.', 3, 2),                                 -- id=25
    ('Ask not what your country can do for you — ask what you can do for your country.', 4, 6),               -- id=26
    ('A lie gets halfway around the world before the truth has a chance to get its pants on.', 9, 6),         -- id=27
    ('We are all mortal until the first kiss and the second glass of wine.', 8, 9);                           -- id=28
