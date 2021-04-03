<?php

namespace App\Controller\Admin;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Field\VichImageField;

class QuestionCrudController extends AbstractCrudController
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public static function getEntityFqcn(): string
    {
        return Question::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('title')->setLabel('La question'),
            VichImageField::new('imageFile')->onlyOnForms(),
            ImageField::new('image')->hideOnForm()->setBasePath($this->params->get('app.path.question_images')),
            Field::new('answers')->setLabel('Réponses')->setHelp('(mettez un $ devant la ou les bonnes réponses)'),
            AssociationField::new('minigame')->setLabel('Epreuve'),
            AssociationField::new('region')->setLabel('Region associée'),
            Field::new('active'),
            AssociationField::new('creator')->hideOnForm(),
            Field::new('createdAt')->hideOnForm(),
            AssociationField::new('lastUpdater')->hideOnForm(),
            Field::new('updatedAt')->hideOnForm(),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('minigame')
            ->add('region')
        ;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            // adds the CSS and JS assets associated to the given Webpack Encore entry
            // it's equivalent to calling encore_entry_link_tags('...') and encore_entry_script_tags('...')
            //->addWebpackEncoreEntry('admin-app')

            ->addHtmlContentToBody("<script>
            const answersContainer = document.querySelector('#Question_answers')
            const config = { attributes: true, childList: true, subtree: true }
            let answersDiv = []
            let answers = []
            let div = document.createElement('div')
            div.id = 'answer_count'

            if(answersContainer) {
                const observer = new MutationObserver(reloadAnswers);
                observer.observe(answersContainer, config);

                document.querySelector('.content-panel-body').insertBefore(div, undefined)
            }

            updateList()

            function reloadAnswers(mutationsList, observer) {
                for(const mutation of mutationsList) {
                    if (mutation.type === 'childList') {
                        updateList()
                    }
                }
            }

            function updateList() {
                answersDiv = document.querySelectorAll('[id^=\"Question_answers_\"]')
                updateCount()
                answersDiv.forEach(el => {
                    if (el.getAttribute('listener') !== 'true') {
                        el.addEventListener('input', (e) => {
                            updateCount()
                        })
                        el.setAttribute('listener', 'true');
                    }
                })
            }

            function updateCount() {
                answers = []
                answersDiv.forEach(e => {
                    if(e.value.slice(0,1) === '$') {
                        answers.push(e.value.replace('$', ''))
                    }
                })
                document.getElementById('answer_count').textContent = 'Bonnes réponses : ' + answers
            }
            </script>")
        ;
    }
}
