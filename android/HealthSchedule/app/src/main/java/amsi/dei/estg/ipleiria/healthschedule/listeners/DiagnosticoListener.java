package amsi.dei.estg.ipleiria.healthschedule.listeners;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.model.Diagnostico;

public interface DiagnosticoListener {

    void onRefreshListaDiagnostico(ArrayList<Diagnostico> diagnosticos);

    void onRefreshdetalhesDiagnosticos();

}
