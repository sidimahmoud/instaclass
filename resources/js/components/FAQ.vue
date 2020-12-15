<template>
<div>
    <div class="container mt-5" v-if="lang==='fr'">
        <div class="text-center border-top border-primary pt-5 mb-3">
            <h3>Réponses aux questions les plus fréquemment posées</h3>
            
        </div>
        <div>
            <p>Note: Dans ce document, le genre masculin est utilisé comme générique, dans le seul but de ne pas alourdir le texte.</p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Quelles séances sont gratuites?
            </p>
            <p>
                Un instructeur peut choisir d’enseigner un cours gratuitement ou de façon payante.<br/> 
                De plus, lorsque ce dernier prévoit enseigner un cours comportant plus de 5 séances, la sixième séance sera gratuite pour les étudiants, cependant ils doivent s’inscrire à la totalité des séances du cours.

            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Est-ce que les instructeurs d’Instantaclasse doivent obligatoirement être des diplômés dans les domaines qu’ils enseignent?
            </p>
            <p>
                Seul l’instructeur doit se filmer, cependant nous croyons qu’il est préférable que les étudiants le soient également.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Qu’arrive-t-il si un étudiant ou un instructeur est mal poli ou désagréable pendant la séance?
            </p>
            <p>
                Sachez que nos administrateurs s’assurent que les séances se déroulent dans le respect et la courtoisie, ainsi nous pouvons en tout temps arrêter un cours ou supprimer et bannir un étudiant ou un instructeur. De plus, les contenus à caractères pornographiques, les propos discriminatoires, sexismes, homophobes ou toute autre forme encourageant la haine ne seront pas tolérés.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Qui peut voir une séance en cours?
            </p>
            <p>
                Une séance en cours est visionnée par les étudiants inscrits au cours, le instructeur lui-même et un administrateur désigné peut s’y joindre pour s’assurer du bon déroulement de ce dernier.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Un instructeur peut-il recevoir du pourboire?
            </p>
            <p>
                Oui en effet, les étudiants peuvent à leur discrétion laisser un pourboire, ce dernier va en totalité à l’instructeur.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Puis-je partager une fiche des cours sur les médias sociaux?

            </p>
            <p>
                Lorsque les onglets de partage sont présente sur une fiche de cours, c’est que l’instructeur autorise que sa fiche peux être partagée.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Pourquoi en tant qu’instructeur mes évaluations sont visibles?
            </p>
            <p>
                Les étudiants ont le choix d’évaluer les cours à la fin de chaque séance, ainsi il devient important de bien structurer sa matière et de veiller à ce que vos cours soient d’une grande qualité.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Quand est-ce que les instructeurs sont payés?
            </p>
            <p>
                Le paiement s’effectue exactement une semaine après que la séance du cours ait été complétée.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Qu’arrive-il si les étudiants jugent qu’un cours ne correspondait pas du tout aux attentes?
            </p>
            <p>
                Lorsqu’un tel cas arrive, nos administrateurs vont visionner la séance, s’ils constatent que tel est le cas, ils pourraient ne pas payer l’instructeur, ils vont cependant rembourser les étudiants.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Peut-on enregistrer une séance?
            </p>

            <p>
                Oui en effet, un instructeur va enregistrer une séance et laisser l’enregistrement à ses étudiants à la fin du cours.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Qu’arrive-il si le cours que je veux enseigner n’est pas répertorié sur la plateforme?
            </p>

            <p>
                Lorsque vous désirez enseigner un cours que vous ne trouvez pas sur la plateforme, vous avez la possibilité de le créer directement, cependant nous vérifierons si ce dernier correspond aux cours permis d’enseigner sur cette plateforme et communiquerons avec vous au besoin.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Quel est le pourcentage perçu par Instantaclasse?
            </p>

            <p>
                Pour le bon déroulement et maintien de la plateforme, une commission de 10% est perçue à chaque séance d’un cours, mais seulement lorsque les séances sont payantes.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Puis-je me joindre à une séance en cours?
            </p>

            <p>
                Il revient à la discrétion de l’instructeur d’autoriser ou non si un étudiant peut se joindre à une séance en cours.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
                Qu’arrive-il si le cours que je veux enseigner n’est pas répertorié sur la plateforme?
            </p>

            <p>
                Lorsque vous désirez enseigner un cours que vous ne trouvez pas sur la plateforme, vous avez la
                possibilité de le créer directement, cependant nous vérifierons si ce dernier correspond aux
                cours permis d’enseigner sur cette plateforme et communiquerons avec vous au besoin.
            </p>
        </div>
        <div>
            <p class="font-weight-bolder">
               Qu’arrive-il si j’oublie que j’avais un cours à suivre?
            </p>

            <p>
                Nous enverrons par émail des rappels des cours aux instructeurs et étudiants, 24h et 1h avant l’heure cédulé. 
                Cependant si un instructeur n’est pas disponible à l’heure prévu sans avoir averti l’administration d’Instantaclasse, les mesures disciplinaires s’appliqueront. Si la même situation se produit pour un étudiant, il ne sera pas remboursé pour la séance manqué.

            </p>
        </div>

        <div class="text-center my-3">
            <h5>Pour toutes questions supplémentaires, veuillez nous écrire sous l’onglet
                <router-link :to="{name: 'Contact'}" tag="a" class="text-primary">
                    Contactez-nous
                </router-link>
            </h5>
        </div>
    </div>
    <div class="container mt-5" v-if="lang==='en'">
        <div class="text-center border-top border-primary pt-5 mb-3">
            <h3>Answers to the most frequently asked questions</h3>
        </div>
        <div>
            <p>
                Note: In this document, the masculine gender is used as a generic, for the sole purpose of not
                overburdening the text.
            </p><br/><br/>
        </div>
        
        <h5>Which sessions are free?</h5>
        <p>
            An instructor can choose to teach a course for free or for a fee.
            In addition, when the instructor plans to teach a course with more than 5 sessions, the sixth session will
            be free for students. However, they must register for all sessions of the course.
        </p>
        <h5>Do Instantaclasse instructors have to be graduates in the fields they teach?</h5>
        <p>    
            It is not required, however they should know and be able to explain the concepts they are teaching.
            What if a student or instructor is rude or obnoxious during the session?
            Please note that our administrators ensure that sessions are conducted with respect and courtesy, so
            we can stop a course at any time or remove and ban a student or instructor. In addition, pornographic
            content, discriminatory, sexism, homophobic or any other form encouraging hatred will not be
            tolerated.
        </p>
        <h5>Who can see a session in progress?</h5>
        <p>
            A session in progress is viewed by students registered in the course, the instructor, and a designated
            administrator can join the course to ensure smooth running of the course.
        </p>
        <h5>Can an instructor receive a tip?</h5>
        <p>
            Yes indeed, students can at their discretion leave a tip, the tip goes in full to the instructor.
            Can I share a course sheet on social media?
            When the sharing tabs are present on a course sheet, it is because the instructor authorizes that his
            sheet can be shared.
        </p>
        <h5>Why are my evaluations visible as an instructor?</h5>
        <p>
            Students have the option of evaluating lessons at the end of each session, so it becomes important to
            structure your material well and ensure that your lessons are of high quality.
        </p>
        <h5>When are instructors paid?</h5>
        <p>
            Payment is made exactly one week after the class session has been completed.
        </p>
        <h5>What if students find that a course did not meet expectations at all?</h5>
        <p>
            When such a case arises, our administrators will watch the session, if they find that this is the case, they
            might not pay the instructor, however they will reimburse the students.
        </p>
        <h5>Can we record a session?</h5>
        <p>
            Yes indeed, an instructor will record a session and leave the recording to his students at the end of the
            course.
        </p>
        <h5>What happens if the course I want to teach is not listed on the platform?</h5>
        <p>
            When you want to teach a course that you cannot find on the platform, you have the possibility to
            create it directly, however we will check if it corresponds to the courses allowed to teach on this
            platform and will contact you if necessary.
        </p>
        <h5>What percentage does Instantaclasse receive?</h5>
        <p>
            For the smooth running and maintenance of the platform, a 10% commission is charged for each session
            of a course, but only when the sessions are paid.
        </p>
        <h5>Can I join a session in progress?</h5>
        <p>It is at the instructor&#39;s discretion whether or not to allow a student to join a session in progress.</p>

        <h5>What happens if the course I want to teach is not listed on the platform?</h5>
        <p>
            When you want to teach a course that you cannot find on the platform, you have the possibility to
            create it directly, however we will check if it corresponds to the courses allowed to teach on this
            platform and will contact you if necessary.
        </p>
        <h5>What if I forget I have a class to take?</h5>
        <p>
            We will send course reminders to instructors and students by email, 24 hours and 1 hour before the
            scheduled time. However, if an instructor is not available at the scheduled time without notifying
            Instantaclasse administration, disciplinary action will apply. If the same situation occurs for a student, he
            will not be reimbursed for the missed session.
        </p>
        <div class="text-center my-3">
            <p>For any additional questions, please write to us under the Contact Us tab</p><br/><br/>
        </div>
    </div>
</div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    name: "FAQ",
    computed: mapGetters(["lang"])
}
</script>

<style scoped>
    .font-weight-bolder{
        font-weight: bolder;
    }
</style>
