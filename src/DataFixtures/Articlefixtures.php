<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Articlefixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $article = new Article();
        $article->setTitre("Test article");
        $article->setDescription("lorem ljzehfhjezljfzeklfjzkfjkzjklfjklezfklzeklfjekzjfkezjfkljkfljezkjfkljfkejfkljzlkfjzjef");
        $article->setImagePath("0072.jpeg");
        $article->setUpdatedAt(new DateTimeImmutable("now"));
        $manager->persist($article);

        //2eme article
        $article = new Article();
        $article->setTitre("Test article 222");
        $article->setDescription("D orem ljzehfhjezljfzeklfjzkfjkzjklfjklezfklzeklfjekzjfkezjfkljkfljezkjfkljfkejfkljzlkfjzjef  clakcjakdjkejdkjkajd");
        $article->setImagePath("0072.jpeg");
        $article->setUpdatedAt(new DateTimeImmutable("now"));
        $manager->persist($article);

        $manager->flush();
    }
}
