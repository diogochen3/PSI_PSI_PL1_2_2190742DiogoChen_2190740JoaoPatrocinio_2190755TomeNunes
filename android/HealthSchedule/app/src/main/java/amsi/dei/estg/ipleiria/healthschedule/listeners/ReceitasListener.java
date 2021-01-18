package amsi.dei.estg.ipleiria.healthschedule.listeners;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.model.Diagnostico;
import amsi.dei.estg.ipleiria.healthschedule.model.Receita;

public interface ReceitasListener {

    void onRefreshListaReceitas(ArrayList<Receita> receitas);

    void onRefreshdetalhesReceitas();

}
